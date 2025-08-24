<div id="company_post_add" class="modal">
    <!-- Modal content -->
    <div class="modal-content profile-edit-container fl-wrap block_box">
        <span class="close">&times;</span>
        <form action="{{ route('site.user-post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="custom-form">
                <div class="col-sm-6">
                    <label>@lang('site.image')</label>
                    <div class="clearfix"></div>
                    <div class="listsearch-input-item fl-wrap">
                        <div class="fuzone">
                            <div class="fu-text">
                                <span><i class="fal fa-images"></i></span>
                                <div class="photoUpload-files fl-wrap"></div>
                            </div>
                            <input type="file" name="image" class="upload">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn color2-bg float-btn">@lang('site.save')
                <i class="fal fa-paper-plane"></i>
            </button>
        </form>
    </div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById("company_post_add");
    // Get the button that opens the modal
    var btn = document.getElementById("myPostAdd");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }
    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
