var Base = function () {
    
};

Base.prototype = {
    url : null,
    method : 'post',
    params : {},
    form : null,
    enctype : null,

    setUrl : function(url){
        this.url = url;
        return this;
    },

    getUrl : function(){
        return this.url;
    },

    setMethod : function(method){
        this.method = method;
        return this;
    },

    getMethod : function(){
        return this.method;
    },

    setParams : function (params) {
        this.params = params;
        return this;
    },

    getParams : function (key) {
        if (typeof key === 'undefined') {
            return this.params;
        }
        if (typeof this.params[key] == 'undefined') {
            return null;
        }
        return this.params[key];
    },

    resetParams : function () {
        this.params = {};
        return this;
    },

    addParams : function (key, value) {
        this.params[key] = value;
        return this;
    },

    removeParams : function (key) {
        if (typeof this.params[key] != 'undefined') {
            delete this.params[key];
        }
        return this;
    },

    manageHtml : function (response) {
        if (typeof response.element == 'undefined') {
            return false;
        }
        if (Array.isArray(response.element)) {
            $.each(response.element, function (key, value) {
                $(value.selector).html(value.html)
            });
        }
        else {
            $(response.element.selector).html(response.element.html);
        }
    },

    setForm: function(button) {
        this.form = $(button).parents("form");
        this.setParams(this.form.serialize());
        this.setMethod(this.form.attr('method'));
        this.setUrl(this.form.attr('action'));
        return this;
    },

    getForm: function() {
        return this.form;
    },

    addRow : function () {
        newTr = $('#newOption').children().children().clone();
        $('#existingOption').prepend(newTr);
    },

    removeRow : function (obj) {
        $(obj).parent().parent().remove();
    },

    uploadFile : function () {
        
        var formData = new FormData();
        var file = $("#image")[0].files;
        formData.append('productFile', file[0]);
        this.setParams(formData);
        self = this;
        var request = $.ajax({
            method : this.getMethod(),
            url : this.getUrl(),
            contentType : false,
            processData : false,
            data : this.getParams(),
            success : function (response) {
                self.manageHtml(response);
            }
        });
                
        return this;
    },

    /* uploadFile: function() {
        var self = this;
        var request = $.ajax({
            url: this.getUrl(),
            method: this.getMethod(),
            data: this.getParams(),
            processData: false,
            contentType: false,
            success: function(response) {
                self.manageHtml(response);
                self.removeParam();
            }
        });
        return this;
    }, */

    setCms : function() {
        var id = '#'+$('form').attr('id');
        cmsContent = CKEDITOR.instances['cms[content]'].getData();
        this.setUrl($(id).attr('action'));
        this.setMethod($(id).attr('method'));
        this.setParams($(id).serializeArray());

        $.each(this.params,function(i,val) {
            if (val['name']=='cms[content]') {
                val['value'] = cmsContent;
            }
        });
        return this;
    },

    load : function () {
        self = this;
        var request = $.ajax({
            method : this.getMethod(),
            url : this.getUrl(),
            data : this.getParams(),
            success : function (response) {
                self.manageHtml(response);
            }
        });
    }
}

var object = new Base();
//object.setUrl('http://localhost/e-commerce/index.php?c=category&a=grid').load();
//object.load();
$(document).ready(function(){
//object.setUrl("http://localhost/e_commerce/index.php?c=category&a=grid");
object.load();
});