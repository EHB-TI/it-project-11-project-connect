'use strict';

import './bootstrap';
import Editor from '@toast-ui/editor';
//import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

const editor = new Editor({
    el: document.querySelector('#editor'),
    height: '600px',
    initialEditType: 'markdown',
    placeholder: 'Write something cool!',
})

document.querySelector('#form_apply_markdown').addEventListener('submit', e => {
    e.preventDefault();
    document.querySelector('#content').value = editor.getMarkdown();
    e.target.submit();
});
