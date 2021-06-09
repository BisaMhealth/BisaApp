var Size = Quill.import('attributors/style/size');
Quill.register(Size, true);

var toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],
    [{'list': 'ordered'}, {'list': 'bullet'}],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'align': [] }],
    [{ 'size': ['14px', '16px', '18px'] }],
]

var options = {
    modules: {
    toolbar: toolbarOptions
    },
    theme: 'snow'
};

var quill = new Quill('#editor', options);
