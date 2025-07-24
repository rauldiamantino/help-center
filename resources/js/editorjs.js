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
    const holder = document.getElementById('content');
    if (!holder) return;

    await destroyEditor();

    editorInstance = new EditorJS({
        holder,
        tools: {
            header: Header,
            list: EditorjsList,
            paragraph: {
                class: CustomParagraph,
                inlineToolbar: true,
            },
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

