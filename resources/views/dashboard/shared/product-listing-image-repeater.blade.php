<div
    class="lister-product-image clearfix"
    data-component="lister-product-image"
    data-modal-id="image-cropper-popup-{{ $image->id }}"
>
    <input
        type="hidden"
        name="existing_images[]"
        value="{{ $image->id }}"
        data-element="existingImageId"
    />
    <input
        type="hidden"
        name="existing_image_metadata[{{ $image->id }}]"
        value="{{ $image->metadata }}"
        data-element="cropData"
    >
    <label class="col-sm-4 control-label"></label>
    <div class="col-sm-8 lister-product-image__display-container">
        <div class="lister-product-image__image-wrapper">
            <img src="{{ $image->url }}" alt="an image" data-element="preview">
        </div>
        <a class="lister-product-image__control btn btn-default" href="#" data-element="delete">
            <i class="fa fa-trash"></i>
        </a>
        <a class="lister-product-image__control btn btn-default" href="#" data-element="startCrop">
            <i class="fa fa-crop"></i>
        </a>
        <a class="lister-product-image__control btn btn-default" href="#" data-element="sort-handle">
            <i class="fa fa-sort"></i>
        </a>
    </div>
    <div class="mfp-hide image-field__cropper-modal" id="image-cropper-popup-{{ $image->id }}">
        <div class="image-field__cropper-wrapper">
            <img class="image-field__croppable-image" src="{{ $image->raw_url }}" data-element="croppableImage" alt="">
        </div>
        <div class="image-field__actions">
            <input type="hidden" name="tempCropData" data-element="tempCropData">
            <button class="btn btn-primary" data-element="submitCrop">Crop</button>
            <button class="btn btn-secondary" data-element="cancelCrop">Cancel</button>
        </div>
    </div>
</div>
