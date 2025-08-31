class CustomParagraph extends Paragraph {
    validate(savedData) {
        return true;
    }
}

let editorInstance = null;

async function destroyEditor() {
    if (editorInstance && typeof editorInstance.destroy === 'function') {
        await editorInstance.destroy();
        editorInstance = null;
        document.getElementById('content').innerHTML = '';
        console.log('[EditorJS] Destroyed');
    }
}

async function initEditor(data) {
    const ImageTool = window.ImageTool;
    const holder = document.getElementById('content');
    const formEditArticle = document.querySelector('#form-edit-article')
    const articleId = formEditArticle?.dataset.articleId;

    if (! holder || ! articleId) {
        return;
    }

    await destroyEditor();

    editorInstance = new EditorJS({
        holder,
        tools: {
            header: {
                class: Header,
                inlineToolbar: true,
                config: {
                    levels: [1, 2, 3, 4],
                    defaultLevel: 2,
                },
            },
            list: EditorjsList,
            paragraph: {
                class: CustomParagraph,
                inlineToolbar: true,
            },
            image: {
                class: ImageTool,
                config: {
                    uploader: {
                        uploadByFile: async (file) => {
                            const formData = new FormData();
                            formData.append('image', file);
                            formData.append('owner_type', 'App\\Models\\Article');
                            formData.append('owner_id', articleId);

                            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            const response = await fetch('/dashboard/upload', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': token,
                                },
                                body: formData
                            });

                            return await response.json();
                        },
                    },
                }
            }
        },
        data: data || {
            time: Date.now(),
            blocks: [],
            version: '2.31.0',
        },
        autofocus: true,
        onChange: async () => {
            const savedData = await editorInstance.save();
            const hiddenInput = document.querySelector('input[wire\\:model\\.defer="content"]');

            if (hiddenInput) {
                hiddenInput.value = JSON.stringify(savedData);
                hiddenInput.dispatchEvent(new Event('input'));
            }
        },
    });

    console.log('[EditorJS] Initialized');
}

document.addEventListener('livewire:navigated', () => {
    const data = window.livewireEditorContent || null;
    initEditor(data);
});

document.addEventListener('livewire:load', () => {
    const data = window.livewireEditorContent || null;
    initEditor(data);
});

