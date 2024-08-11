import Vue from 'vue';
import CKEditor from 'ckeditor4-vue';

Vue.use( CKEditor );

// CKEditor.editorConfig = function( config ) {
//     config.fullPage = true;
//     config.extraPlugins = 'docprops';
// };

// CKEditor.plugins.addExternal( 'editorplaceholder', 'https://raw.githack.com/ckeditor/ckeditor4/major/plugins/editorplaceholder/plugin.js' );


// fullPage: true,
// extraPlugins: 'docprops',
// // Disable content filtering because if you use full page mode, you probably
// // want to  freely enter any HTML content in source mode without any limitations.
// allowedContent: true,
// height: 320,
// removeButtons: 'PasteFromWord'

// CKEditor.replace('editor1', {
//       fullPage: true,
//       extraPlugins: 'docprops',
//       // Disable content filtering because if you use full page mode, you probably
//       // want to  freely enter any HTML content in source mode without any limitations.
//       allowedContent: true,
//       height: 320,
//       removeButtons: 'PasteFromWord'
//     });
