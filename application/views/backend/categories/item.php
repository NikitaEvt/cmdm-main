<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/<?= ADM_CONTROLLER ?>/menu/">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?= $parent_url ?>"><?= $parent_title ?></a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?= $title ?></span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"><?= $title ?></h1>
<!-- END PAGE TITLE-->

<?php // Отображаем сообщения пользователю ?>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-block alert-success fade in">
        <button type="button" class="close" data-dismiss="alert"></button>
        <?= $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-block alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert"></button>
        <?php foreach ($_SESSION['error'] as $error) : ?>
            <?= $error ?>
            <br/>
        <?php endforeach; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="row">
    <div class="portlet light">
        <div class="portlet-body">

            <form method="post" enctype="multipart/form-data">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li class="active">
                        <a href="#tab_1_1" data-toggle="tab">Информация</a>
                    </li>
                                        <li class="">
                                            <a href="#tab_1_2" data-toggle="tab">Служебная информация</a>
                                        </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_1_1">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td>Родительская категория</td>
                                        <td>
                                            <select name="parent_id" id="" class="form-control">
                                                <option value="0"> - Выбрать категорию -</option>
                                                <?php options_categories_parse($categories_tree,0,0, $item->parent_id);?>
                                            </select>
                                        </td>
                                    </tr>
                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td>Название <?= $lang ?> *</td>
                                            <td><input type="text" name="title<?= $lang ?>"
                                                       value="<?= $item->{'title' . $lang} ?>" class="form-control" <?=$lang == 'EN'?'':'required'?>></td>
                                        </tr>
                                    <? } ?>
                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td>Описание <?= $lang ?> </td>
                                            <td><input type="text" name="desc<?= $lang ?>"
                                                       value="<?= $item->{'desc' . $lang} ?>" class="form-control" ></td>
                                        </tr>
                                    <? } ?>
                                    <tr>
                                        <td width="200">Фото</td>
                                        <td>
                                            <input type="file" name="img" id="file" class="form-control">
                                            <div class="note note-warning"
                                                 style="margin-bottom: 0px; margin-top: 10px;">
                                                <p>
                                                    Допустимые размеры: 450x381 2мб
                                                </p>
                                            </div>
                                            <?php if (!empty($item->img)): ?>
                                                <?php $src = newthumbs($item->img, $table, 256, 256, '256x256x0', 0) ?>
                                                <br>
                                                <div class="mt-element-card mt-element-overlay">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-overlay-1">
                                                                <img src="<?= $src ?>"/>
                                                                <div class="mt-overlay">
                                                                    <ul class="mt-info">
                                                                        <li>
                                                                            <a class="btn red mine_delete_photo"
                                                                               data-table="<?= $table ?>"
                                                                               data-id="<?= $item->id ?>"
                                                                               href="javascript:;">
                                                                                <i class="fa fa-ban"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">&nbsp;</td>
                                        <td>
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Обновить
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                    </div>
                    <div class="tab-pane fade" id="tab_1_2">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                <?foreach ($langs as $lang) {?>
                                    <tr>
                                        <td width="200">Заголовок <?=$lang?></td>
                                        <td>
                                            <input type="text" value="<?=$item->{'seoTitle'.$lang}?>" name="seoTitle<?=$lang?>" class="form-control">
                                        </td>
                                    </tr>
                                <?}?>
                                <?foreach ($langs as $lang) {?>
                                    <tr>
                                        <td width="200">Ключевые слова <?=$lang?></td>
                                        <td>
                                                <textarea name="seoKeywords<?=$lang?>" id="seoKeywords<?=$lang?>" cols="30" rows="10"
                                                          class="form-control"><?=$item->{'seoKeywords'.$lang}?></textarea>
                                        </td>
                                    </tr>
                                <?}?>
                                <?foreach ($langs as $lang) {?>
                                    <tr>
                                        <td width="200">Описание <?=$lang?></td>
                                        <td>
                                                <textarea name="seoDesc<?=$lang?>" id="seoDesc<?=$lang?>" cols="30"
                                                          rows="10" class="form-control"><?=$item->{'seoDesc'.$lang}?></textarea>
                                        </td>
                                    </tr>
                                <?}?>
                                <tr>
                                    <td width="200">&nbsp;</td>
                                    <td>
                                        <button type="submit" class="btn green"><i class="fa fa-check"></i> Изменить
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

