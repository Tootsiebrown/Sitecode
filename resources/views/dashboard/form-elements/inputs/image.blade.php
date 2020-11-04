@php
if (!isset($allowCrop)) {
    $allowCrop = false;
}
@endphp
<div class="image-field__wrapper" data-component="image-field" data-allow-crop="{{ $allowCrop ? 1 : 0 }}">
    <input
        type="file"
        name="cms_image_{{ $name }}"
        data-element="fileInput"
        class="{{ $value ? 'hidden' : '' }} form-control"
        data-path="{{ $path }}"
    />
    <input type="hidden" value="{{ $value }}" name="{{ $name }}" data-element="filenameInput">
    <input type="hidden" name="{{ $name }}_metadata" value="nothing" data-element="meta">
    <img class="{{ $value ? '' : 'hidden' }} image-field__image" src="/storage/uploads/{{ $path }}/{{ $value }}" data-element="image" alt="">
    <button data-element="delete" class="{{ $value ? '' : 'hidden' }} btn btn-secondary">Delete</button>
    @if ($allowCrop)
        <button data-element="startCrop" class="{{ $value ? '' : 'hidden' }} btn btn-default">Crop</button>
    @endif
    <div class="image-field__spinner" data-element="spinner">
        <img src="/assets/img/loading-spinner.gif" alt="loading">
    </div>
    <p class="new-product-image__message" data-element="message"></p>

    @if ($allowCrop)
        <div class="mfp-hide image-field__cropper-modal" id="image-cropper-popup-{{ $name }}">
            <img class="image-field__croppable-image" src="/storage/uploads/{{ $path }}/{{ $value }}" data-element="croppableImage" alt="">
            <input type="hidden" name="tempCropData">
            <button class="btn btn-primary">Crop</button>
            <button class="btn btn-secondary">Cancel</button>
        </div>
    @endif
</div>

