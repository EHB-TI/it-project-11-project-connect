'use strict';

import Editor from '@toast-ui/editor'
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

document.addEventListener("DOMContentLoaded", function() {
    const editor = new Editor({
      el: document.getElementById('editor'), // Updated syntax
      height: '400px',
      initialEditType: 'markdown',
      placeholder: 'Enter Your Project Description Here',
    });
  
    document.querySelector('#createPostForm').addEventListener('submit', e => {
      e.preventDefault();
      document.querySelector('#content').value = editor.getMarkdown();
      e.target.submit();
    });
  });
  