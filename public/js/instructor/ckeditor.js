// No necesitas importar nada aquí, ya que CKEditor y los plugins se incluirán desde el CDN
ClassicEditor
    .create(document.querySelector('#description'), {
        toolbar: [
            'heading', '|', 'bold', 'italic', 'link', 'blockQuote', 'imageUpload'
        ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        },
        extraPlugins: [MyCustomUploadAdapterPlugin], // Añadir el adaptador personalizado
    })
    .catch(error => {
        console.error(error);
    });

// Función para el adaptador personalizado
function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new MyUploadAdapter(loader);
    };
}

// Adaptador personalizado
class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve({ default: reader.result });
                reader.onerror = error => reject(error);
            }));
    }

    abort() {
        // Manejo de la cancelación
    }
}
