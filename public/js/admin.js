$( document ).ready(function() {
'use strict';
    function reload(){
        location.reload(true);
    }

//bootstrap-switch
    $(".switch").bootstrapSwitch();
    $(".switch").on('switchChange.bootstrapSwitch', function(event, state) {
        var state = $(this).bootstrapSwitch('state');
        if(state == true){
            $(this).val(1);
        }else{
            $(this).val(0);
        }
    });
    //switch promo
    $("#promoProd").on('switchChange.bootstrapSwitch', function(event, state) {
        var state = $(this).bootstrapSwitch('state');
        if(state == true){
            $(this).val(1);
            $('#prix_ht_promo, #prix_ttc_promo').removeAttr('disabled');
        }else{
            $(this).val(0);
            $('#prix_ht_promo, #prix_ttc_promo').attr('disabled','disabled');
        }
    });
//swal alert constante

    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
    })
    const toast = swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    function calcul_tva(source,target1,target2){
        var prix_ht =  $(target1).val();
        var taux_tva  = $('#tva').val();
        var prix_ttc = $(target2).val();

        if(source==2)
        {
            var new_prix_ht = (prix_ttc/(1+taux_tva/100)).toFixed(2);
            $(target1).val(new_prix_ht);
        }
        else
        {
            var new_prix_ttc = (prix_ht*(1+taux_tva/100)).toFixed(2);
            $(target2).val(new_prix_ttc);
        }
    };
//datatable
    $('#catTable').DataTable( {
        paging: false,
        bInfo : false,
        language: {
            search: "Rechercher :"
        },
        "columnDefs": [
            { "orderable": false, "targets": 2},
            { "orderable": false, "targets": 3}
        ]
    } );
//finiton selected
    $('.finition').click(function(){
        if($(this).hasClass('finitionSel')){
            $(this).removeClass('finitionSel');
            $(this).css({'color': 'white', 'background-color': '#2CA8FF'});
        }else{
            $(this).addClass('finitionSel');
            $(this).css({'color': '#495057', 'background-color': '#fff'});
        }
    });
/******************Rubriques****************************/

//store a new rubric

    $('#newRubricButton').click(function(e){
        /* $(".notification").addClass('none');*/
        var token = $('#token').val();
        var name = $('#nameRubric').val();
        var onLine = $('#onLine').val();
        $.ajax({
            type : 'POST',
            url: '/admin/rubriques',
            data:{token : token, name: name, view: onLine},
            success: function (data) {
                $(location).attr('href','/admin/rubriques/'+data+'/edit');
            },
            error:function (request) {
                var errors = jQuery.parseJSON(request.responseText);
                var ul = document.createElement('ul');
                $.each(errors, function (key, value) {
                    var li = document.createElement('li');
                    li.appendChild(document.createTextNode(value));
                    ul.appendChild(li);
                });
                //$(".notification").removeClass("alert-success");
                $(".notification").removeClass("none");
                $('.msgNotification').html(ul);
            }
        });
        e.preventDefault();
    });

//update rubric
    $('.updateRubButton').click(function(e){
        // $(".notification").addClass('none');
        var token = $('#token').val();
        var id = $('#idCat').val();
        var name = $('#nameCat').val();
        var onLine = $('.onLineCheck').val();
        var title = $('#titleCat').val();
        var metaDescription = $('#metaDescCat').val();
        var metaKeywords = $('#metaKeyCat').val();
        $.ajax({
            type : 'POST',
            url: '/admin/rubriques/'+id+'/update',
            data:{
                token : token,
                name: name,
                id: id,
                view : onLine,
                title : title,
                metaDescription : metaDescription,
                metaKeywords : metaKeywords
            },
            success: function (data) {
                var response = jQuery.parseJSON(data);
                $(".notification").removeClass("alert-danger");
                $(".notification").addClass('alert-success').removeClass("none");
                $('.msgNotification').html('<strong>'+response.success+'</strong>');
            },
            error:function (request) {
                var errors = jQuery.parseJSON(request.responseText);
                var ul = document.createElement('ul');
                $.each(errors, function (key, value) {
                    var li = document.createElement('li');
                    li.appendChild(document.createTextNode(value));
                    ul.appendChild(li);
                });
                $(".notification").removeClass("alert-success");
                $(".notification").addClass('alert-danger').removeClass("none");
                $('.msgNotification').html(ul);
            }
        });
        e.preventDefault();
    });
// delete rubric
    $('.delRubButton').click(function(e){
        var idCategory = $(this).attr('data-id');
        var nameCategory = $(this).attr('data-name');
        var token = $('#token'+idCategory).val();
        swal({
            title: 'Êtes vous sûr ?',
            text: "La rubrique "+nameCategory+" et tout son contenu vont êtres supprimer définitivement !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler',
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type : 'POST',
                    url: '/admin/rubriques/'+idCategory+'/delete',
                    data:{token : token,id: idCategory},
                    success: function (data) {
                        $('#tr'+idCategory).remove();
                        swal(
                            'Deleted!',
                            'Catégorie est supprimée.',
                            'success'
                        )
                    },
                    error:function (request) {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Une erreur est survenue!',
                            footer: '<a href>Réesseyez ou contacter votre administrateur?</a>'
                        })
                    }
                });
            }
        })
    });
    //activation ou desactivation d'une rubriques et son contenue
    $('.activationRub').on('switchChange.bootstrapSwitch', function(event, state){
        var idCategory = $(this).attr('data-id');
         $.ajax({
            type : 'POST',
            url: '/admin/rubriques/'+idCategory+'/activation',
            data:{id : idCategory, view : $('.activation'+idCategory).val()},
            success: function (data) {
                toast({
                    type: 'success',
                    title: 'Rubrique modifiée'
                })
            },
            error:function (request) {
                toast({
                    type: 'error',
                    title: 'une erreur est survenue'
                })
            }
        });
    });

/******************categories****************************/
/*checkbox on line change value
    $('.onLineCheck').click(function(){
        var onLine = $(this).val();
        if(onLine == 0){
            $(this).val(1);
        }else{
            $(this).val(0);
        }
    });*/
//activation ou desactivation d'une catégorie dans la liste page categorie
    $('.activationCat').on('switchChange.bootstrapSwitch', function(event, state){
        var idCategory = $(this).attr('data-id');
        $.ajax({
            type : 'POST',
            url: '/admin/categories/'+idCategory+'/activation',
            data:{id : idCategory, view : $('.activation'+idCategory).val()},
            success: function (data) {
                toast({
                    type: 'success',
                    title: 'Catégorie modifiée'
                })
            },
            error:function (request) {
                toast({
                    type: 'error',
                    title: 'une erreur est survenue'
                })
            }
        });
    });
//store a new category

$('#newCatButton').click(function(e){
   /* $(".notification").addClass('none');*/
    var token = $('#tokenCat').val();
    var rubric = $('#idRub').val();
    var name = $('#nameCat').val();
    var onLine = $('#onLine').val();
    $.ajax({
        type : 'POST',
        url: '/admin/categories',
        data:{token : token, name: name, view: onLine, rubric_id : rubric},
        success: function (data) {
           $(location).attr('href','/admin/categories/'+data+'/edit');
        },
        error:function (request) {
            var errors = jQuery.parseJSON(request.responseText);
            var ul = document.createElement('ul');
            $.each(errors, function (key, value) {
                var li = document.createElement('li');
                li.appendChild(document.createTextNode(value));
                ul.appendChild(li);
            });
            //$(".notification").removeClass("alert-success");
            $(".notification").removeClass("none");
            $('.msgNotification').html(ul);
        }
    });
    e.preventDefault();
});

// update category and sous category
$('.updateCatButton').click(function(e){
   // $(".notification").addClass('none');
    var token = $('#token').val();
    var id = $('#idCat').val();
    var name = $('#nameCat').val();
    var description = $('#descCat').val();
    var rubric_id = $('#rubric_id').val();
    var onLine = $('.onLineCheck').val();
    var title = $('#titleCat').val();
    var metaDescription = $('#metaDescCat').val();
    var metaKeywords = $('#metaKeyCat').val();
    var imageCat = $('#imageCat').val();
    $.ajax({
        type : 'POST',
        url: '/admin/categories/'+id+'/update',
        data:{
            token : token,
            name: name,
            id: id,
            rubric_id : rubric_id,
            description : description,
            view : onLine,
            imageCat : imageCat,
            title : title,
            metaDescription : metaDescription,
            metaKeywords : metaKeywords
        },
        success: function (data) {
            setTimeout(reload, 2000);
            toast({
                type: 'success',
                title: 'Catégorie modifiée'
            })
        },
        error:function (request) {
            var errors = jQuery.parseJSON(request.responseText);
            var ul = document.createElement('ul');
            $.each(errors, function (key, value) {
                var li = document.createElement('li');
                li.appendChild(document.createTextNode(value));
                ul.appendChild(li);
            });
            $(".notification").removeClass("alert-success");
            $(".notification").addClass('alert-danger').removeClass("none");
            $('.msgNotification').html(ul);
        }
    });
    e.preventDefault();
});
// delete category
    $('.delCatButton').click(function(e){
        var idCategory = $(this).attr('data-id');
        var nameCategory = $(this).attr('data-name');
        var token = $('#token'+idCategory).val();
        swal({
            title: 'Êtes vous sûr ?',
            text: "La catégorie "+nameCategory+" et ses produits vont êtres supprimer définitivement !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler',
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type : 'POST',
                    url: '/admin/categories/'+idCategory+'/delete',
                    data:{token : token,id: idCategory},
                    success: function (data) {
                        $('#tr'+idCategory).remove();
                        swal(
                            'Deleted!',
                            'Catégorie supprimée.',
                            'success'
                        )
                    },
                    error:function (request) {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Une erreur est survenue!',
                            footer: '<a href>Réesseyez ou contacter votre administrateur?</a>'
                        })
                    }
                });
            }
        })
    });

/****************SOUS_CATEGORIES***********************/
//datatable
    $('#subCatTable').DataTable( {
        language: {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher&nbsp;:",
            "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst":      "Premier",
                "sPrevious":   "Pr&eacute;c&eacute;dent",
                "sNext":       "Suivant",
                "sLast":       "Dernier"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            },
            "select": {
                "rows": {
                    _: "%d lignes séléctionnées",
                    0: "Aucune ligne séléctionnée",
                    1: "1 ligne séléctionnée"
                }
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": 2},
            { "orderable": false, "targets": 3}
        ]
    } );
//new soubcategory
$('#newSousCatButton').click(function(e){
    /* $(".notification").addClass('none');*/
    var token = $('#tokenSousCat').val();
    var name = $('#nameSousCat').val();
    var category = $('#idCat').val();
    var rubric = $('#idRub').val();
    var onLine = $('#onLine').val();
    $.ajax({
        type : 'POST',
        url: '/admin/subcategories/add',
        data:{token : token, name: name, category_id : category, view: onLine, rubric_id : rubric},
        success: function (data) {
            $(location).attr('href','/admin/subcategories/'+data+'/edit');
        },
        error:function (request) {
            var errors = jQuery.parseJSON(request.responseText);
            var ul = document.createElement('ul');
            $.each(errors, function (key, value) {
                var li = document.createElement('li');
                li.appendChild(document.createTextNode(value));
                ul.appendChild(li);
            });
            //$(".notification").removeClass("alert-success");
            $(".notification").removeClass("none");
            $('.msgNotification').html(ul);
        }
    });
    e.preventDefault();
});

    $('.updateSubCatButton').click(function(e){
        // $(".notification").addClass('none');
        var token = $('#token').val();
        var id = $('#idCat').val();
        var name = $('#nameCat').val();
        var description = $('#descCat').val();
        var onLine = $('.onLineCheck').val();
        var title = $('#titleCat').val();
        var metaDescription = $('#metaDescCat').val();
        var metaKeywords = $('#metaKeyCat').val();
        var imageSubCat = $('#imageCat').val();
        var rubric_id = $('#rubric_id').val();
        var category_id = $('#category_id').val();
        $.ajax({
            type : 'POST',
            url: '/admin/subcategories/'+id+'/update',
            data:{
                token : token,
                name: name,
                id: id,
                rubric_id: rubric_id,
                category_id: category_id,
                description : description,
                view : onLine,
                imageSubCat : imageSubCat,
                title : title,
                metaDescription : metaDescription,
                metaKeywords : metaKeywords
            },
            success: function (data) {
                var response = jQuery.parseJSON(data);
                setTimeout(reload, 2000);
                toast({
                    type: 'success',
                    title: 'Catégorie modifiée'
                })
                //$(".notification").removeClass("alert-danger");
                //$(".notification").addClass('alert-success').removeClass("none");
                //$('.msgNotification').html('<strong>'+response.success+'</strong>');
            },
            error:function (request) {
                var errors = jQuery.parseJSON(request.responseText);
                var ul = document.createElement('ul');
                $.each(errors, function (key, value) {
                    var li = document.createElement('li');
                    li.appendChild(document.createTextNode(value));
                    ul.appendChild(li);
                });
                $(".notification").removeClass("alert-success");
                $(".notification").addClass('alert-danger').removeClass("none");
                $('.msgNotification').html(ul);
            }
        });
        e.preventDefault();
    });


// delete category
    $('.delSubCatButton').click(function(e){
        var idCategory = $(this).attr('data-id');
        var nameCategory = $(this).attr('data-name');
        var token = $('#token'+idCategory).val();
        swal({
            title: 'Êtes vous sûr ?',
            text: "La catégorie "+nameCategory+" et ses produits vont êtres supprimer définitivement !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler',
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type : 'POST',
                    url: '/admin/subcategories/'+idCategory+'/delete',
                    data:{token : token,id: idCategory},
                    success: function (data) {
                        $('#tr'+idCategory).remove();
                        swal(
                            'Deleted!',
                            'Catégorie est supprimée.',
                            'success'
                        )
                    },
                    error:function (request) {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Une erreur est survenue!',
                            footer: '<a href>Réesseyez ou contacter votre administrateur?</a>'
                        })
                    }
                });
            }
        })
    });
    //activation ou desactivation d'une catégorie dans la liste page categorie
    $('.activationSubCat').on('switchChange.bootstrapSwitch', function(event, state){
        var idCategory = $(this).attr('data-id');
        $.ajax({
            type : 'POST',
            url: '/admin/subcategories/'+idCategory+'/activation',
            data:{id : idCategory, view : $('.activation'+idCategory).val()},
            success: function (data) {
                toast({
                    type: 'success',
                    title: 'Catégorie modifiée'
                })
            },
            error:function (request) {
                toast({
                    type: 'error',
                    title: 'une erreur est survenue'
                })
            }
        });
    });

/****************Products***********************/

    $('#newProductButton').click(function(e){
        /* $(".notification").addClass('none');*/
        var token = $('#tokenProduct').val();
        var name = $('#nameProduct').val();
        var rubric = $('#idRubric').val();
        var category = $('#idCat').val();
        var subcat = $('#idSubCat').val();
        var ref = $('#refProduct').val();
        $.ajax({
            type : 'POST',
            url: '/admin/products/add',
            data:{token : token, name: name, category_id : category, sub_category_id : subcat,reference:ref, rubric_id : rubric},
            success: function (data) {
                $(location).attr('href','/admin/products/'+data+'/edit');
            },
            error:function (request) {
                var errors = jQuery.parseJSON(request.responseText);
                var ul = document.createElement('ul');
                $.each(errors, function (key, value) {
                    var li = document.createElement('li');
                    li.appendChild(document.createTextNode(value));
                    ul.appendChild(li);
                });
                //$(".notification").removeClass("alert-success");
                $(".notification").removeClass("none");
                $('.msgNotification').html(ul);
            }
        });
        e.preventDefault();
    });
    //activation
    $('.activationProduct').on('switchChange.bootstrapSwitch', function(event, state){
        var idPro = $(this).attr('data-id');
        $.ajax({
            type : 'POST',
            url: '/admin/products/'+idPro+'/activation',
            data:{id : idPro, view : $('.activation'+idPro).val()},
            success: function (data) {
                if($('.activation'+idPro).val()==1){
                    toast({
                        type: 'success',
                        title: 'Produit activé'
                    })
                }
                else{
                    toast({
                        type: 'warning',
                        title: 'Produit désactivé'
                    })
                }
            },
            error:function (request) {
                toast({
                    type: 'error',
                    title: 'une erreur est survenue'
                })
            }
        });
    });
    // delete prod
    $('.delProduct').click(function(e){
        var idPro = $(this).attr('data-id');
        var namePro = $(this).attr('data-name');
        var token = $('#token'+idPro).val();
        swal({
            title: 'Êtes vous sûr ?',
            text: "Le produit "+namePro+" va être supprimer définitivement !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler',
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type : 'POST',
                    url: '/admin/products/'+idPro+'/delete',
                    data:{token : token,id: idPro},
                    success: function (data) {
                        $('#tr'+idPro).remove();
                        toast({
                            type: 'success',
                            title: 'Produit supprimé'
                        })
                    },
                    error:function (request) {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Une erreur est survenue!',
                            footer: '<a href>Réesseyez ou contacter votre administrateur?</a>'
                        })
                    }
                });
            }
        })
    });
/******************************load select formulaire******************************************************/
    //load list category
    $('#rubric_id').change(function(){
        $('#category_id').html('<option>Choisissez une sous-catégorie</option>');
        var rubric_id = $('#rubric_id').val();
        $.ajax({
            type : 'POST',
            url: '/admin/subcategories/'+rubric_id+'/getCategories',
            success: function (data) {
                var response = jQuery.parseJSON(data);
                if(response.length){
                    $.each(response, function (key, value) {
                        $('#category_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }else {
                    $('#category_id').append('<option value="">rien à afficher</option>');
                }
            },
            error:function (request) {

            }
        });
    });
    //load list collection
    $('#brand_id').change(function(){
        $('#collection_id').removeAttr('disabled');
        $('#collection_id').html('<option>Choisissez une collection</option>');
        var brand_id = $('#brand_id').val();
        $.ajax({
            type : 'POST',
            url: '/admin/products/'+brand_id+'/getCollections',
            success: function (data) {
                var response = jQuery.parseJSON(data);
                if(response.length){
                    $.each(response, function (key, value) {
                        $('#collection_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }else {
                    $('#collection_id').append('<option value="">rien à afficher</option>');
                }
            },
            error:function (request) {

            }
        });
    });
    // calcul prix TTC


    $('#prix_ttc').keyup(function(){
        calcul_tva(2,'#prix_ht','#prix_ttc');
    });
    $('#prix_ht').keyup(function(){
        calcul_tva(1,'#prix_ht','#prix_ttc');
    });
    $('#prix_ttc_promo').keyup(function(){
        calcul_tva(2,'#prix_ht_promo','#prix_ttc_promo');
    });
    $('#prix_ht_promo').keyup(function(){
        calcul_tva(1,'#prix_ht_promo','#prix_ttc_promo');
    });
    /**********************************************************/
    var tabimage=new Array();
    $('.addFileBt').click(function(){
        $('#fileupload').click();
    });
    /*$('#file').change(function(){
        function createThumbnail(file) {
            var reader = new FileReader();
            reader.addEventListener('load', function() {
                var imgElement = document.createElement('img');
                imgElement.style.maxWidth = '150px';
                imgElement.style.maxHeight = '150px';
                imgElement.src = this.result;
                if( $.inArray( imgElement.src, tabimage) == -1 ){
                    tabimage.push(imgElement.src);
                    $('#prev').append('<div class="col-sm-3 imageBoxe d-flex justify-content-center flex-column"><img src="'+this.result+'" alt=""><button class="btn btn-danger btn-sm btn-round"><i class="fas fa-times"></i></button></div>');
                }
            });
            reader.readAsDataURL(file);
        }
        var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'],
            fileInput = document.querySelector('#file'),
            prev = document.querySelector('#prev');
        fileInput.addEventListener('change', function() {
            var files = this.files,
                filesLen = files.length,
                imgType;

            for (var i = 0; i < filesLen; i++) {
                imgType = files[i].name.split('.');
                imgType = imgType[imgType.length - 1];
                if (allowedTypes.indexOf(imgType) != -1) {
                    createThumbnail(files[i]);
                }
            }
        });
    });*/
    $(function () {
        var files = $("#files");
        var productId = $('#idProduct').val();
        $("#fileupload").fileupload({
            url: '/admin/products/uploadFile',
            dropZone: '#dropZone',
            dataType: 'json',
            autoUpload: false,
            formData: {product_id: productId}
        }).on('fileuploadadd', function (e, data) {
            var fileTypeAllowed = /.\.(gif|jpg|png|jpeg)$/i;
            var fileName = data.originalFiles[0]['name'];
            var fileSize = data.originalFiles[0]['size'];

            if (!fileTypeAllowed.test(fileName))
                $("#error").html('Only images are allowed!');
            else if (fileSize > 500000)
                $("#error").html('Your file is too big! Max allowed size is: 500KB');
            else {
                $("#error").html("");
                data.submit();
            }
        }).on('fileuploaddone', function(e, data) {
            var status = data.jqXHR.responseJSON.status;
            var msg = data.jqXHR.responseJSON.msg;

            if (status == 1) {
                var path = data.jqXHR.responseJSON.path;
                $(".imageLoad").fadeIn().append('<div class="col-sm-4 imgBox"><img style="width: 100px; height: 100px;" src="/images/uploads/'+path+'" /></div>');
            } else
                $("#error").html(msg);
        }).on('fileuploadprogressall', function(e,data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $("#progress").html("Completed: " + progress + "%");
        });
    });
//-----------------------------------------------------------
});

