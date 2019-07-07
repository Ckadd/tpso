var Theme = function (options) {

    this.options = _.merge({
        themeId: null,
        url: {
            getThemeFile: '',
            saveThemeFile: ''
        },
        el: {
            saveEditButton: null
        },
        message: {
            editFileSuccess: ''
        }
    }, options)

    this.codeMirror = null
    this.editingPath = null
    this.request = new Request


    this.bindEvent()

}

Theme.prototype = {

    constructor: function () {

    },

    bindEvent: function () {

        var self = this

        this.options.el.saveEditButton.addEventListener('click', function () {
            
            self.saveFile()
        })
    },

    initCodeMirror: function (textarea) {

        this.codeMirror = CodeMirror.fromTextArea(textarea, {
            lineNumbers: true,
            matchBrackets: true,
            mode: "application/x-httpd-php",
            indentUnit: 4,
            indentWithTabs: true
        })

        this.codeMirror.setSize('100%', 600)
    },

    handleTextAreaLoading: function () {

        var wrapper = document.getElementById('file-textarea-wrapper')

        return {
            show: function () {
                wrapper.classList.add('is-loading')
            },
            hide: function () {
                wrapper.classList.remove('is-loading')
            }
        }
    },

    setEditingPath: function (path) {

        this.editingPath = path

        return this;
    },

    getEditingPath: function () {

        return this.editingPath
    },

    initFileTree: function (element, listDir) {

        var self = this
        
        new Vue({
            el: element,

            data: function () {

                return {
                    treeData: listDir
                }
            },

            methods: {
                onFileSelected: function (node) {

                    var path = node.data.path,
                        request = self.request
                        request = request.create()

                    if (node.data.type == 'dir') {

                        return
                    }

                    self.handleTextAreaLoading().show()

                    request.get(self.options.url.getThemeFile + '/' + path)
                        .then(function (response) {

                            self.codeMirror.setValue(response.data.data.content)
                            self.handleTextAreaLoading().hide()
                            self.setEditingPath(path)
                        })
                }
            }
        })
    },

    saveFile: function () {

        var path = this.getEditingPath(),
            self = this

        if (!path) {

            return false
        }

        self.handleTextAreaLoading().show()

        this.request.create().post(this.options.url.saveThemeFile, {
            id: self.options.themeId,
            path: path,
            content: this.codeMirror.getValue()
        })
        .then(function (response) {

            self.handleTextAreaLoading().hide()
            toastr.success(self.options.message.editFileSuccess);
        })        
    }
}