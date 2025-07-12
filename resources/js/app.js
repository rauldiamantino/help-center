// resources/js/app.js

import './bootstrap'; // Se você usa o bootstrap padrão do Laravel

// Importe EditorJS e suas ferramentas
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import Paragraph from '@editorjs/paragraph';
// Importe outras ferramentas que for usar, ex:
// import SimpleImage from '@editorjs/simple-image';
// import Embed from '@editorjs/embed';
// import CodeTool from '@editorjs/code';

// Torna as classes globais para que o Blade possa encontrá-las facilmente
// Esta é uma abordagem comum quando você não está usando um framework de frontend completo.
window.EditorJS = EditorJS;
window.Header = Header;
window.List = List;
window.Paragraph = Paragraph;
// window.SimpleImage = SimpleImage;
// window.Embed = Embed;
// window.CodeTool = CodeTool;

// Opcional: Se você usa Alpine.js, pode querer adicionar o editor a uma data property para melhor gerenciamento
// document.addEventListener('alpine:init', () => {
//     Alpine.data('editorjs', () => ({
//         editor: null,
//         init() {
//             this.editor = new EditorJS({ /* ... */ });
//         }
//     }));
// });
