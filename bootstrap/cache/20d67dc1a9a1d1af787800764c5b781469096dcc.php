<?php $__env->startSection('title','Product Category'); ?>
<?php $__env->startSection('data-page-id','exploreCategory'); ?>
<?php $__env->startSection('sectionTitle',$rubric->name); ?>
<?php $__env->startSection('sectionDesc','Contenue de la rubrique.'); ?>
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
                    <li class="breadcrumb-item active"><?php echo e($rubric->name); ?>&nbsp;<a href="/admin/rubriques/<?php echo e($rubric->id); ?>/edit">(modification)</a></li>
                </ol>
                <div class="card-header">
                    <h4 class="card-title"> Catégories</h4>
                </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary btn-fab btn-icon btn-round" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <?php if(count($categories)): ?>
                    <table class="table table-bordered table-striped " id="subCatTable">
                        <thead>
                        <tr>
                            <th class="text-center">Position</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">En ligne</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="tr<?php echo e($cat->id); ?>">
                                <td class="text-center"><?php echo e($cat->position); ?></td>
                                <td>
                                    <a href="/admin/categories/<?php echo e($cat->id); ?>/"> <?php echo e($cat->name); ?></a>
                                </td>
                                <td >
                                    <div class="md-form d-flex justify-content-center">
                                        <input type="checkbox" class="switch activationCat activation<?php echo e($cat->id); ?>" name="my-checkbox"  data-size="mini"  data-off-text="Non" data-on-text="Oui" <?php if($cat->view ): ?> value="1" checked <?php else: ?> value="0" <?php endif; ?> data-id="<?php echo e($cat->id); ?>">
                                    </div>
                                </td>
                                <td class="td-actions text-right d-flex justify-content-end">
                                    <a href="/admin/categories/<?php echo e($cat->id); ?>/">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon mr-2">
                                            <i class="fa fa-folder-open"></i>
                                        </button>
                                    </a>
                                    <a href="/admin/categories/<?php echo e($cat->id); ?>/edit">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon mr-2">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon delCatButton" data-id ="<?php echo e($cat->id); ?>" data-name ="<?php echo e($cat->name); ?>" >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <input id="token<?php echo e($cat->id); ?>" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-warning mt-3">
                        <span>
                            <b> Désolé - </b> Pas de sous-catégorie à afficher
                        </span>
                    </div>
                <?php endif; ?>
                <!--produit-->
                <div class="card-header">
                    <h4 class="card-title">Produits</h4>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="/admin/rubriques/addproduct" title="Ajouter un produit">
                            <button class="btn btn-primary btn-fab btn-icon btn-round">
                                <i class="fas fa-plus"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="alert alert-warning mt-3">
                        <span>
                            <b> Désolé - </b> Pas de produits à afficher
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel">Créer une nouvelle catégorie dans <strong><?php echo e($rubric->name); ?></strong></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning alert-dismissible fade show none notification" role="alert">
                    <strong class="msgNotification"></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form>
                    <input id="tokenCat" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                    <input id="idRub" name="rubric_id" type="hidden" value="<?php echo e($rubric->id); ?>">
                    <div class="form-group">
                        <label for="nameCat">Nom de la catégorie</label>
                        <input type="texte" class="form-control " name="name" id="nameCat" aria-describedby="Nom" placeholder="Entrer ici le nom de la catégorie que vous souhaitez créer">
                    </div>
                    <div class="text-left pt-2">
                        <Label class="mr-2 switch-lab">En Ligne : </Label>
                        <input type="checkbox" class="switch onLineCheck" id="onLine" name="view"  data-size="mini"  data-off-text="Non" data-on-text="Oui" value="0">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Annuler</button>
                <button id="newCatButton" type="button" class="btn btn-info"><i class="fas fa-check"></i>&nbsp;Créer </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>