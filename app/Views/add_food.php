<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

    <style>
        .error {
            color: red;
            font-size: 14px;
        }
    </style>

    <div class="container mt-5">
        <h2 class="text-center">Add Food Item</h2>
        <div class="card shadow p-4">
            <form id="foodForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Food Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter food name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Food</button>
            </form>
        </div>
<!--        <div id="message" class="mt-3 text-center"></div>-->
    </div>

    <script>
        $(document).ready(function () {
            $("#foodForm").validate({
                rules: {
                    name: {required: true, minlength: 3, maxlength: 50},
                    price: {required: true, number: true, min: 1},
                    category_id: {required: true}
                },
                messages: {
                    name: {required: "Food name is required", minlength: "At least 3 characters"},
                    price: {
                        required: "Price is required",
                        number: "Enter a valid price",
                        min: "Price must be greater than 0"
                    },
                    category_id: {required: "Please select a category"}
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: "<?= base_url('food/add') ?>",
                        type: "POST",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function (response) {
                            if (response.status === "success") {
                                Swal.fire({
                                    title: '',
                                    text: `Food Item Saved!`,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok',
                                    reverseButtons: true
                                }).then((result) => {
                                    $("#foodForm")[0].reset();
                                })
                            } else {
                                $("#message").html('<div class="alert alert-danger">' + response.message + '</div>');
                            }
                        }
                    });
                }
            });
        });
    </script>

<?= $this->endSection() ?>