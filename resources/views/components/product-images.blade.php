<div class="col">
    <div class="bd-example-snippet bd-code-snippet">
        <div class="bd-example m-0 border-0">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="d-flex mt-4 ms-4 mb-4">
                <div>
                    @foreach ($images as $image)
                        <img 
                            id="thumbnail-image" 
                            class="main-img bd-placeholder-img img-thumbnails" 
                            src="{{ asset('gallery_products/thumbnails/' . $image->thumbnail) }}" 
                            alt="Описание изображения" width="150" height="150"
                            onmouseover="changeOriginalImage({{ $loop->index }}, '{{ asset('gallery_products/images/' . $image->image) }}')"
                        >
                    @endforeach
                </div>
                <div>
                    <img id="original-image" class="main-img bd-placeholder-img img-original" src="{{ asset('gallery_products/images/' . $images[0]->image) }}" alt="Описание изображения" width="500" height="500">
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    function changeOriginalImage(index, imagePath) {
        const originalImage = document.getElementById('original-image');
        originalImage.src = imagePath;
    }
</script>