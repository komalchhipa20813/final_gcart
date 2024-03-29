<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <span class="text-semibold"><?php _el('edit_category');?></span>
            </h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard');?></a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/categories'); ?>"><?php _el('categories');?></a>
            </li>
            <li class="active"><?php _el('edit');?></li>
        </ul>
    </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <!-- Panel -->
            <div class="panel panel-flat">
                <!-- Panel heading -->
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="panel-title">
                                <strong><?php _el('category');?></strong>
                            </h5>
                        </div>
                    </div>
                </div>
                <!-- /Panel heading -->
                <!-- Panel body -->
                <div class="panel-body">
                     <form action="<?php echo base_url('admin/categories/edit/').$category['id']; ?>" id="categories_form" method="POST" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                              <small class="req text-danger">* </small>
                              <label><?php _el('banner_name') ?></label>
                              <select class="select-search" name="banner_id" id="banner_id">
                                <option value="0" selected readonly disabled>----- Select Banner -----</option>
<?php
    $banners = get_banners();

    foreach ($banners as $banner)
    {
?>
                                    <option id="$banner['id']" name="banner" value="<?php echo $banner['id'] ?>"
                                        <?php
                                                if ($banner['id'] == $category['banner_id'])
                                                {
                                                    echo ' selected';
                                                }
                                            ?>> <?php echo ucfirst($banner['title']) ?></option>
<?php
    }
?>
                                </select>
                            </div>
                            <div class="form-group">
                                <small class="req text-danger">* </small>
                                <label><?php _el('name');?>:</label>
                                <input type="text" class="form-control" placeholder="<?php _el('name');?>" id="name" name="name" value="<?php echo $category['name'] ?>" oninput="generate_slug()">
                            </div>
                            <div class="form-group">
                                <small class="req text-danger">* </small>
                                <label><?php _el('slug');?>:</label>
                                <input type="text" class="form-control" placeholder="<?php _el('slug');?>" id="slug" name="slug" value="<?php echo $category['slug'] ?>">
                            </div>
<?php
    $icon = basename($category['icon']);
?>

                            <div class="form-group">
                                <label><?php _el('icon');?>:</label>
                                <image name="icon1" id='icon1' src="<?php echo base_url('assets/uploads/main_categories/').$icon ?>" width="400" height="200">
                            </div>
                            <div class="form-group">
                                <input type="file"  class="file-input"  name="icon" id='icon' data-show-caption="false" data-show-upload="false">
                            </div>
<?php
    $readonly = '';
?>
                            <div class="form-group">
                                <label><?php _el('status');?>:</label>
                                <input type="checkbox" class="switchery" name="is_active" id="<?php echo $category['id']; ?>"<?php
                                    if ($category['is_active'] == 1)
                                    {
                                    echo 'checked';}
                                ?><?php echo $readonly; ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i class="icon-checkmark3 position-left"></i><?php _el('save');?></button>
                                    <a href="javascript:window.history.back();" class="btn btn-default"><i class="icon-undo2 position-left"></i><?php _el('back');?></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Panel body -->
            </div>
            <!-- /Panel -->
            </div>
  </div>
<!-- /Content area -->

<script type="text/javascript">
$('.select-search').select2();

$("#categories_form").validate({
    rules: {
        name: {
            required: true,
        },
        slug: {
            required: true,
        },
        banner_id: {
            required: true,
        }
    },
    messages: {
        name: {
            required:"<?php _el('please_enter_', _l('name'))?>"
        },
        slug: {
            required:"<?php _el('please_enter_', _l('slug'))?>"
        },
        banner_id: {
            required:"<?php _el('please_select_', _l('banner'))?>",
        },
    }
});

$('.file-input').fileinput({
        browseLabel: 'Browse',
        browseIcon: '<i class="icon-file-plus"></i>',
        removeIcon: '<i class="icon-cross3"></i>',
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>',
            main1: "{preview}\n" +
            "<div class='input-group {class}'>\n" +
            "   <div class='input-group-btn'>\n" +
            "       {browse}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "   <div class='input-group-btn'>\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "</div>"
        },
        initialCaption: "choose file",
    });

/**
 *  generate a slug from category_name
 */
function generate_slug()
{
    var str = document.getElementById('name').value;
    var slug = '';
    var trimmed = $.trim(str);
    slug = trimmed.replace(/[^a-z0-9&-]/gi, '-').
    replace(/[&]/g,'and').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');

    var slug = slug.toLowerCase();
    document.getElementById("slug").value = slug;
}
</script>
