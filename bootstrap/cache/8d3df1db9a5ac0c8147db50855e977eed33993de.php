<!-----test si on veut modifier une catégorie ou une sous categorie -------->
<?php

    if(isset($rubric)){
        if(isset($category)){
            if(isset($subCat)){
                $role = 3;
                $data = $subCat;
            }else{
                $role = 2;
                $data = $category;
            }
        }else{
            $role = 1;
            $data = $rubric;
        }
    }

?>

<?php $__env->startSection('title','Edition Categorie'); ?>
<?php $__env->startSection('data-page-id','editCategory'); ?>
<?php $__env->startSection('sectionTitle',$data->name); ?>
<?php $__env->startSection('sectionDesc','Mise à jour de la catégorie.'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header ">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/admin/rubriques">Catalogue</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/admin/rubriques/<?php echo e($rubric->id); ?>/"><?php echo e($rubric->name); ?></a>
                    </li>
                    <?php if($role >= 2): ?>
                        <li class="breadcrumb-item">
                            <a href="/admin/categories/<?php echo e($category->id); ?>/"><?php echo e($category->name); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if($role == 3): ?>
                        <li class="breadcrumb-item">
                            <a href="/admin/subcategories/<?php echo e($subCat->id); ?>"><?php echo e($subCat->name); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active">Edition</li>
                </ol>
                <div class="alert alert-danger fade show none notification" role="alert">
                    <strong class="msgNotification"></strong>
                </div>
                <div class="card-header">
                    <h6 class="card-title"> MISE À JOUR DE <?php echo e($data->name); ?></h6>
                </div>
            </div>
            <div class="card-body ">
                <div class="d-flex justify-content-end">
                    <?php if($role == 1): ?>
                        <button class="mr-2 btn btn-info updateRubButton">Enregistrer&nbsp; <i class="fas fa-check"></i></button>
                        <form action="/admin/rubriques">
                            <button class="btn btn-danger">Fermer&nbsp; <i class="fas fa-times"></i></button>
                        </form>
                    <?php elseif($role == 2): ?>
                        <button class="mr-2 btn btn-info updateCatButton">Enregistrer&nbsp; <i class="fas fa-check"></i></button>
                        <form action="/admin/rubriques/<?php echo e($rubric->id); ?>/">
                            <button class="btn btn-danger">Fermer&nbsp; <i class="fas fa-times"></i></button>
                        </form>
                    <?php else: ?>
                    <button class="mr-2 btn btn-info updateSubCatButton">Enregistrer&nbsp; <i class="fas fa-check"></i></button>
                    <form action="/admin/categories/<?php echo e($category->id); ?>/">
                        <button class="btn btn-danger">Fermer&nbsp; <i class="fas fa-times"></i></button>
                    </form>
                    <?php endif; ?>

                </div>
                <div class="card card-nav-tabs card-plain">
                    <div class="card-header card-header-danger">
                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#descGen" data-toggle="tab">Description générale</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#seo" data-toggle="tab">SEO</a>
                                    </li>
                                    <?php if($role != 1): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#imgs" data-toggle="tab">Images</a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div><div class="card-body ">
                        <div class="tab-content text-center">
                            <!-----Partie dédiée aux informations générale-------->
                            <div class="tab-pane active" id="descGen">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group text-left">
                                            <label for="nameCat" class="ml-2 mb-2 f700">Nom de la Catégorie<b>*</b> </label>
                                            <input type="texte" class="form-control form-controlBordered" id="nameCat" value="<?php echo e($data->name); ?>">
                                        </div>
                                        <?php if($role != 1): ?>
                                        <div class="form-group text-left">
                                            <label for="nameCat" class="ml-2 mb-2 f700">Description</label>
                                            <textarea class="form-control textareaBordered" id="descCat" rows="10" ><?php echo e($data->description); ?></textarea>
                                            <span class="help-block">Une courte description, utilisée lorsqu'un résumé ou une introduction est requise</span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?php if($role != 1): ?>
                                            <div class="form-group">
                                                <label for="rubric_id" class="ml-2 mb-2 f700">Rubrique</label>
                                                <select class="form-control form-controlBordered" id="rubric_id">
                                                    <?php $__currentLoopData = $rubrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($category->rubric_id == $rub->id): ?>
                                                            <option value="<?php echo e($rub->id); ?>" selected><?php echo e($rub->name); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($rub->id); ?>"><?php echo e($rub->name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                             <?php if($role==3): ?>
                                             <div class="form-group">
                                                 <label for="category_id" class="ml-2 mb-2 f700">Catégorie Parente</label>
                                                 <select class="form-control form-controlBordered" id="category_id">
                                                 <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($subCat->category_id == $cat->id): ?>
                                                        <option value="<?php echo e($cat->id); ?>" selected><?php echo e($cat->name); ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 </select>
                                            </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <div class="text-left pt-2">
                                            <Label class="mr-2 switch-lab f700 ">En Ligne : </Label>
                                            <input type="checkbox" class="switch onLineCheck" name="view"  data-size="mini"  data-off-text="Non" data-on-text="Oui" <?php if($data->view == 1): ?> value="1" checked <?php else: ?> value="0" <?php endif; ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-----Partie dédiée aux infos SEO-------->

                            <div class="tab-pane" id="seo">
                                <div class="form-group text-left">
                                    <label for="titleCat" class="ml-2 mb-2 f700">Titre de la page</label>
                                    <input type="texte" class="form-control form-controlBordered" id="titleCat" value="<?php echo e($data->title); ?>" placeholder="Assurez-vous d'avoir un titre clair et qui contient les mots-clés correspondant à la page en cours">
                                    <span class="help-block">L'élément HTML TITLE est le plus important dans votre page</span>
                                </div>
                                <div class="form-group text-left">
                                    <label for="metaDescCat" class="ml-2 mb-2 f700">Meta description</label>
                                    <textarea class="form-control textareaBordered" id="metaDescCat" rows="10"  placeholder="Assurez-vous d'avoir des mots-clés présents dans la page courante"><?php echo e($data->metaDescription); ?></textarea>
                                    <span class="help-block">Votre description ne devrait pas dépasser 150 à 160 caractères</span>
                                </div>
                                <div class="form-group text-left">
                                    <label for="metaKeyCat" class="ml-2 mb-2 f700">Meta keywords</label>
                                    <textarea class="form-control textareaBordered" id="metaKeyCat" rows="10"  placeholder="Ne répétez pas sans cesse les mêmes mots-clés dans une lignes. Préférez utiliser des expressions de mots-clés. "><?php echo e($data->metaKeywords); ?></textarea>
                                    <span class="help-block">Vous n'avez pas besoin d'utiliser de virgules ou d'autres signes de ponctuation</span>
                                </div>
                            </div>
                            <?php if($role != 1): ?>
                            <!-----Partie dédiée à l'image-------->
                            <div class="tab-pane text-center" id="imgs">
                                <div class="apercu">
                                    <img src="/images/noimage.png" alt="">
                                </div>
                                <input type="text" value="noimage.png" id="imageCat" >
                            </div>
                            <?php endif; ?>
                            <input id="token" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                            <input id="idCat" name="idCat" type="hidden" value="<?php echo e($data->id); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <small class="m-3">Rubrique créée le <?php echo e($data->created_at); ?>. Dernière modification le <?php echo e($data->updated_at); ?></small>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>