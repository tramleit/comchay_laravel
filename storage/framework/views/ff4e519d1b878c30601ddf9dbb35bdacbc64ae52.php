
<?php $__env->startSection('content'); ?>
<main>
    <div class="container px-1 md:px-0 mx-auto">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-3 mt-8 md:mt-0 order-1 lg:order-0">
                <?php echo $__env->make('homepage.common.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-span-12 lg:col-span-9 space-y-6 mt-5 md:mt-0 order-0 lg:order-1">
                <div>
                    <div class="flex justify-between items-center border-b border-global">
                        <h2 class="h2-category h2-main text-global font-bold text-lg  tracking-tighter relative pb-1"><span class="uppercase"> Cập nhập trích dẫn</span></h2>
                    </div>
                    <form class="mt-3 space-y-3" method="post" action="" id="form-comment">
                        <?php echo csrf_field(); ?>

                        <div class="flex items-center">
                            <label class="w-[100px] font-bold">Chuyên mục</label>
                            <select disabled="disabled" name="catalogue_id" class="flex-1 form-control block w-full px-4 py-2 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="">Chọn chuyên mục</option>
                                <?php if(!$CategoryArticle->isEmpty()): ?>
                                <?php $__currentLoopData = $CategoryArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php if ($detail->catalogue_id == $item->id) { ?>selected<?php } ?> <?php if (request()->get('id') == $item->id) { ?>selected<?php } ?>><?php echo e($item->title); ?></option>
                                <?php if(count($item->children) > 0): ?>
                                <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>" <?php if ($detail->catalogue_id == $value->id) { ?>selected<?php } ?> <?php if (request()->get('id') == $value->id) { ?>selected<?php } ?>>|-----<?php echo e($value->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="flex items-center">
                            <label class="w-[100px] font-bold">Chủ đề</label>
                            <input type="text" name="title" class="flex-1 form-control block w-full px-4 py-2 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" value="<?php echo e($detail->title); ?>" disabled="disabled" placeholder="" />
                        </div>
                        <div class="error_comment">
                            <div class="bg-green-100 border border-green-400 text-green-700-700 px-4 py-3 rounded relative my-3 alert alert-success" style="display: none">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline js_text_success">
                                </span>
                            </div>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-3 alert alert-danger" style="display: none">
                                <strong class="font-bold">ERROR!</strong>
                                <span class="block sm:inline js_text_danger">
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col ">
                            <label class="w-[100px] font-bold mb-3">Nội dung</label>
                            <div>
                                <?php echo Form::textarea('message', $detail_comment_id->message, ['id' => 'ckDescription', 'class' => 'ck-editor', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" id="form-comment-submit" class="bg-global text-white flex items-center  px-7 py-3  font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                <span>Cập nhập trích dẫn</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>
<style>
    input[type="text"]:disabled,
    select:disabled {
        background: #dddddd;
        cursor: no-drop;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>
<script src="<?php echo e(asset('library/ckeditor-frontend/ckeditor.js')); ?>" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".ck-editor").each(function() {
            //colorbutton,
            CKEDITOR.replace(this.id, {
                filebrowserUploadUrl: "<?php echo e(route('image.store', ['_token' => csrf_token() ])); ?>",
                filebrowserUploadMethod: 'form',
                height: 700,
                removeButtons: "",
                extraPlugins: "colorbutton, panelbutton, link, justify, lineheight, youtube, videodetector, image, imageresize, font, codemirror, copyformatting, find, qrc, slideshow, preview, hkemoji, contents, googledocs, codesnippet",
                entities: false,
                entities_latin: false,
                allowedContent: true,
                toolbarGroups: [{
                        name: "clipboard",
                        groups: ["clipboard", "undo"],
                    },
                    {
                        name: "editing",
                        groups: ["find", "selection", "spellchecker"],
                    },
                    {
                        name: "links",
                    },
                    {
                        name: "insert",
                    },
                    {
                        name: "forms",
                    },
                    {
                        name: "tools",
                    },
                    {
                        name: "document",
                        groups: ["mode", "document", "doctools"],
                    },
                    {
                        name: "colors",
                    },
                    {
                        name: "others",
                    },
                    {
                        name: "fonts",
                    },
                    "/",
                    {
                        name: "basicstyles",
                        groups: ["basicstyles", "cleanup"],
                    },
                    {
                        name: "paragraph",
                        groups: ["list", "indent", "blocks", "align", "bidi"],
                    },
                    {
                        name: "styles",
                    },
                ],
            });
        });
    })
</script>
<script type="text/javascript">
    $('#form-comment-submit').click(function(e) {
        e.preventDefault();
        var message = CKEDITOR.instances['ckDescription'].getData();;
        var module_id = "<?php echo e($detail->id); ?>";
        var comment_id = "<?php echo e($detail_comment_id->id); ?>";
        let form = new FormData();
        form.append('message', message);
        form.append('module_id', module_id);
        form.append('comment_id', comment_id);
        $.ajax({
            type: 'POST',
            url: "<?php echo route('chude.updateComment') ?>",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            success: function(responsive) {
                if (responsive == 200) {
                    $('.error_comment .alert-danger').hide();
                    $('.error_comment .alert-success').show();
                    $('.error_comment .js_text_success').html("Cập nhập trích dẫn thành công");
                    $('html, body').animate({
                        scrollTop: $(".error_comment").offset().top
                    }, 200);
                    setTimeout(function() {
                        window.location.href = "<?php echo route('chude.index', ['id' => $detail->id, 'slug' => slug($detail->title)]); ?>";
                    }, 1500);
                } else {
                    $('.error_comment .alert-danger').show();
                    $('.error_comment .alert-success').hide();
                    $('.error_comment .js_text_danger').html("ERROR");
                    $('html, body').animate({
                        scrollTop: $(".error_comment").offset().top
                    }, 200);
                }
            },
            error: function(jqXhr, json, errorThrown) {
                // this are default for ajax errors
                var errors = jqXhr.responseJSON;
                $('.error_comment .alert-danger').show();
                var errorsHtml = "";
                $.each(errors.errors, function(index, value) {
                    errorsHtml += value + "/ ";
                });
                if (errorsHtml.length > 0) {
                    $('.error_comment .js_text_danger').html(errorsHtml);
                } else {
                    $('.error_comment .js_text_danger').html(errors.message);
                }
                $('html, body').animate({
                    scrollTop: $(".error_comment").offset().top
                }, 200);
            },


        });

    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel.local\resources\views/briefing/frontend/briefing/edit.blade.php ENDPATH**/ ?>