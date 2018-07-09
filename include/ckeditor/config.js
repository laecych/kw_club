/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// CKEDITOR.editorConfig = function( config ) {
// 	// Define changes to default configuration here. For example:
// 	// config.language = 'fr';
// 	// config.uiColor = '#AADC6E';
// };

// /**
//  * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
//  * For licensing, see LICENSE.md or http://ckeditor.com/license


CKEDITOR.editorConfig = function (config) {
	config.toolbarGroups = [
		{ name: 'document', groups: ['mode', 'document', 'doctools'] },
		{ name: 'clipboard', groups: ['clipboard', 'undo'] },
		{ name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing'] },
		{ name: 'forms', groups: ['forms'] },
		{ name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
		{ name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
		{ name: 'links', groups: ['links'] },
		{ name: 'insert', groups: ['insert'] },
		{ name: 'styles', groups: ['styles'] },
		{ name: 'colors', groups: ['colors'] },
		{ name: 'tools', groups: ['tools'] },
		{ name: 'others', groups: ['others'] },
		{ name: 'about', groups: ['about'] }
	];

	config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,Replace,Find,SelectAll,Scayt,Form,Radio,Checkbox,TextField,Textarea,Select,Button,ImageButton,HiddenField,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Flash,Iframe,SpecialChar,About,ShowBlocks,Maximize,PasteText,PasteFromWord,Undo,Redo,CopyFormatting';

	config.filebrowserBrowseUrl = 'elFinder/elfinder_cke.php';
	config.height = 400;


	config.toolbar = 'myBasic';
	config.toolbar_myBasic =
		[
			['Source', 'Format', 'FontSize', 'TextColor', 'BGColor', 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', 'Outdent', 'Indent', '-', 'Link', 'Unlink', '-', 'PasteText', 'PasteFromWord', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Table', 'Undo', 'Redo']
		];
	config.height = 200;	
};

