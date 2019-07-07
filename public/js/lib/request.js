var Request = function () {
    
}

Request.prototype = {

    constructor: function () {
        
    },

    getCSRFToken: function () {

        return document.head.querySelector('meta[name="csrf-token"]')
    },

    create: function () {

        return axios.create({
            headers: {
                common: {
                }
            }
        })
    }
}