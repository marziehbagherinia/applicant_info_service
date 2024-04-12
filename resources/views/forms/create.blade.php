<!DOCTYPE html>
<html lang = "{{ str_replace('_', '-', app()->getLocale()) }}" dir = "rtl">
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">

    <title>فرم اطلاعات کاربر</title>

    <!-- Bootstrap CSS -->
    <link href = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel = "stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .form-group {
            text-align: right;
        }
        .form-group label {
            font-weight: bold;
            display: block; /* Display the label as block element */
        }
        .form-group .education-input {
            display: flex; /* Display skill inputs inline */
            align-items: center; /* Align items vertically center */
        }
        .form-group input[type="text"], .form-group select {
            width: 100%; /* Set width for input fields to take up the entire line */
            margin-right: 5px; /* Add some space between inputs */
        }
        .form-group .add-attirbute-btn, .form-group .remove-attribute-btn {
            width: 120px; /* Fixed width for buttons */
            margin-right: 5px; /* Add some space between button and other fields */
            flex-shrink: 0; /* Prevent button from shrinking */
        }
        .card-header {
            text-align: right;
            background-color: #f8f9fa; /* Add a light background color for better contrast */
            direction: rtl; /* Force right-to-left alignment */
            text-align: right; /* Align text to the right */
        }
        .custom-select {
            width: 100%;
            margin-right: 5px;
            height: calc(2.25rem + 2px); /* Adjust height to match other fields */
            color: #495057; /* Match text color with other fields */
        }
    </style>
</head>

<body>
    <div class = "container mt-5">
        <div class = "row justify-content-center">
            <div class = "col-md-8">
                <div class = "card">
                    <div class = "card-header">فرم اطلاعات کاربر</div>
                        <div class = "card-body">
                            <form method = "POST" action = "{{ url( '/api/v1/forms' ) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="operator_id">نام اپراتور</label>
                                    <select class="form-control select2 custom-select" id="operator_id" name="operator_id">
                                        <option value="">انتخاب کنید</option>
                                        <?php
                                        // Assuming you have a database connection already established
                                        $operators = DB::table('operators')->get();
                                        foreach ($operators as $operator) {
                                            echo "<option value='{$operator->id}'>{$operator->name}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class = "form-group">
                                    <label for = "user_name">نام کاربر</label>
                                    <input type = "text" class = "form-control" id = "user_name" name = "user_name" placeholder = "نام کاربر را وارد کنید">
                                </div>

                                <div class = "form-group">
                                    <label for = "age">سن</label>
                                    <input type = "number" class = "form-control" id = "age" name = "age" placeholder = "سن را وارد کنید" required>
                                </div>

                                <div class = "form-group">
                                    <label for = "gender">جنسیت</label>
                                    <select class = "form-control" id = "gender" name = "gender" required>
                                        <option value = "male">مرد</option>
                                        <option value = "female">زن</option>
                                    </select>
                                </div>

                                <div class = "form-group">
                                    <label for = "preferred_learning_format">نوع آموزش ترجیحی</label>
                                    <select class = "form-control" id = "preferred_learning_format" name = "preferred_learning_format" required>
                                        <option value = "online">آنلاین</option>
                                        <option value = "onsite">حضوری</option>
                                        <option value = "hybrid">ترکیبی</option>
                                    </select>
                                </div>

                                <div class = "form-group">
                                    <label for = "learning_goal">هدف آموزش</label>
                                    <select class = "form-control" id = "learning_goal" name = "learning_goal" required>
                                        <option value = "educational">تحصیلی</option>
                                        <option value = "work">کاری</option>
                                        <option value = "other">سایر</option>
                                    </select>
                                </div>

                                <div class = "form-group" id = "other_learning_goal" style = "display: none;">
                                    <label for = "other_goal"></label>
                                    <input type = "text" class = "form-control" id = "other_goal" name = "other_goal" placeholder = "هدف کاربر از آموزش را وارد نمایید">
                                </div>

                                <div class = "form-group">
                                    <label for = "job">شغل</label>
                                    <input type = "text" class = "form-control" id = "job" name = "job" placeholder = "شغل را وارد کنید" required>
                                </div>

                                <div class = "form-group">
                                    <label for = "current_education">مقطع تحصیلی فعلی</label>
                                    <div class = "row">
                                        <div class = "col">
                                            <select class = "form-control" id = "education_degree" name = "education_degree" required>
                                                <option value = "" selected disabled>مقطع تحصیلی</option>
                                                <option value = "دیپلم">دیپلم</option>
                                                <option value = "کارشناسی">کارشناسی</option>
                                                <option value = "کارشناسی ارشد">کارشناسی ارشد</option>
                                                <option value = "دکتری">دکتری</option>
                                            </select>
                                        </div>
                                        <div class = "col">
                                            <input type = "text" class = "form-control" id = "education_major" name = "education_major" placeholder = "رشته تحصیلی" required>
                                        </div>
                                    </div>
                                </div>

                                <div class = "form-group">
                                    <label for = "courses">مقطع درخواستی</label>
                                    <div id = "courseContainer">
                                        <div class = "education-input">
                                            <select name = "courses[][degree]" class = "education-degree form-control">
                                                <option value = "" selected disabled>مقطع درخواستی</option>
                                                <option value = "associate">کاردانی</option>
                                                <option value = "bachelor">کارشناسی</option>
                                                <option value = "master">کارشناسی ارشد</option>
                                                <option value = "phd">دکتری</option>
                                                <option value = "skill">مهارتی</option>
                                            </select>
                                            <input type = "text" name = "courses[][title]" class = "education-field form-control" placeholder = "عنوان دوره">
                                            <button type = "button" class = "add-attirbute-btn btn btn-success">اضافه کردن</button>
                                        </div>
                                    </div>
                                </div>

                                <div class = "form-group">
                                    <label for = "migration_preference">آیا کاربر تمایلی به مهاجرت دارد؟</label>
                                    <select class = "form-control" id = "migration_preference" name = "migration_preference" required>
                                        <option value = "true">بله</option>
                                        <option value = "false">خیر</option>
                                    </select>
                                </div>

                                <div class = "form-group">
                                    <label for = "languages">مهارت زبان</label>
                                    <div id = "languageContainer">
                                        <div class = "education-input">
                                            <select name = "languages[][title]" class = "education-degree form-control">
                                                <option value = "" selected disabled>نوع زبان</option>
                                                <option value = "english">انگلیسی</option>
                                                <option value = "arabic">عربی</option>
                                                <option value = "turkish">ترکی</option>
                                                <option value = "german">آلمانی</option>
                                                <option value = "french">فرانسوی</option>
                                                <option value = "italian">ایتالیایی</option>
                                                <option value = "spanish">اسپانیایی</option>
                                                <option value = "russian">روسی</option>
                                                <option value = "chienese">چینی</option>
                                                <option value = "japanese">ژاپنی</option>
                                                <option value = "korean">کره ای</option>
                                            </select>
                                            <select name = "languages[][level]" class = "education-field form-control">
                                                <option value = "" selected disabled>سطح زبان</option>
                                                <option value = "elementary">مقدماتی</option>
                                                <option value = "intermediate">متوسط</option>
                                                <option value = "advanced">پیشرفته</option>
                                            </select>
                                            <button type = "button" class = "add-attirbute-btn btn btn-success">اضافه کردن</button>
                                        </div>
                                    </div>
                                </div>

                                <div class = "form-group">
                                    <label for = "skills">سایر مهارت ها</label>
                                    <div id = "skillContainer">
                                        <div class = "education-input">
                                            <input type = "text" name = "skills[][title]" class = "education-degree form-control" placeholder = "نوع مهارت">
                                            <select name = "skills[][level]" class = "education-field form-control">
                                                <option value = "" selected disabled>سطح مهارت</option>
                                                <option value = "elementary">مقدماتی</option>
                                                <option value = "intermediate">متوسط</option>
                                                <option value = "advanced">پیشرفته</option>
                                            </select>
                                            <button type = "button" class = "add-attirbute-btn btn btn-success">اضافه کردن</button>
                                        </div>
                                    </div>
                                </div>

                                <div class = "mb-4"></div> <!-- Add space above the button using Bootstrap margin utility classes -->

                                <div class = "row">
                                    <div class = "col-md-4"> <!-- Adjust the width by changing the grid class -->
                                        <button type = "submit" class = "btn btn-primary btn-block">ارسال فرم</button> <!-- Add btn-block class to make the button full width -->
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready( function() {
            // Initialize Select2
            $('.select2').select2( {
                dir: "rtl",
                placeholder: "جست و جو...",
                allowClear: true // Add a clear button
            } );
        } );

        document.addEventListener( "DOMContentLoaded", function() {
            var selectElement = document.getElementById( "learning_goal" );
            var otherInput = document.getElementById( "other_learning_goal" );

            selectElement.addEventListener( "change", function()
            {
                if ( selectElement.value === "other" )
                {
                    otherInput.style.display = "block";
                    otherInput.querySelector( "input" ).setAttribute( "required", "required" );
                }
                else
                {
                    otherInput.style.display = "none";
                    otherInput.querySelector( "input" ).removeAttribute( "required" );
                }
            } );
        } );

        $(document).ready( function() {
            // Disable the button by default
            $('.add-attirbute-btn').prop('disabled', true);

            $('#courseContainer').on('input', '.education-degree, .education-field', function() {
                // Check if both fields have values
                var degreeVal = $(this).closest('.education-input').find('.education-degree').val().trim();
                var levelVal = $(this).closest('.education-input').find('.education-field').val().trim();

                // Enable or disable the button based on the fields' values
                if (degreeVal !== '' && levelVal !== '') {
                    $(this).closest('.education-input').find('.add-attirbute-btn').prop('disabled', false);
                } else {
                    $(this).closest('.education-input').find('.add-attirbute-btn').prop('disabled', true);
                }
            });

            $('#courseContainer').on('click', '.add-attirbute-btn', function() {
                var $btn = $(this);

                // Change the button text to "حذف کردن"
                $btn.text('حذف کردن').addClass('remove-attribute-btn').removeClass('add-attirbute-btn');

                // Append a new skill input field with appropriate distance
                var newSkillInput = '<div class="mt-3 education-input">' + // Adding margin top for appropriate distance
                    '<select name = "courses[][degree]" class = "education-degree form-control">' +
                    '<option value = "" selected disabled>مقطع درخواستی</option>' +
                    '<option value = "english">کاردانی</option>' +
                    '<option value = "arabic">کارشناسی</option>' +
                    '<option value = "turkish">کارشناسی ارشد</option>' +
                    '<option value = "german">دکتری</option>' +
                    '<option value = "french">مهارتی</option>' +
                    '</select>' +
                    '<input type="text" name="courses[][title]" class="education-field form-control" placeholder="عنوان دوره">' +
                    '<button type="button" class="add-attirbute-btn btn btn-success" disabled>اضافه کردن</button>' +
                    '</div>';
                $('#courseContainer').append(newSkillInput);
            });

            $('#courseContainer').on('click', '.remove-attribute-btn', function() {
                $(this).closest('.education-input').remove();
            });
        } );

        $(document).ready( function() {
            // Disable the button by default
            $('.add-attirbute-btn').prop('disabled', true);

            $('#languageContainer').on('input', '.education-degree, .education-field', function() {
                // Check if both fields have values
                var degreeVal = $(this).closest('.education-input').find('.education-degree').val().trim();
                var levelVal = $(this).closest('.education-input').find('.education-field').val().trim();

                // Enable or disable the button based on the fields' values
                if (degreeVal !== '' && levelVal !== '') {
                    $(this).closest('.education-input').find('.add-attirbute-btn').prop('disabled', false);
                } else {
                    $(this).closest('.education-input').find('.add-attirbute-btn').prop('disabled', true);
                }
            });

            $('#languageContainer').on('click', '.add-attirbute-btn', function() {
                var $btn = $(this);

                // Change the button text to "حذف کردن"
                $btn.text('حذف کردن').addClass('remove-attribute-btn').removeClass('add-attirbute-btn');

                // Append a new skill input field with appropriate distance
                var newSkillInput = '<div class="mt-3 education-input">' + // Adding margin top for appropriate distance
                    '<select name = "languages[][title]" class = "education-degree form-control">' +
                    '<option value = "" selected disabled>نوع زبان</option>' +
                    '<option value = "english">انگلیسی</option>' +
                    '<option value = "arabic">عربی</option>' +
                    '<option value = "turkish">ترکی</option>' +
                    '<option value = "german">آلمانی</option>' +
                    '<option value = "french">فرانسوی</option>' +
                    '<option value = "italian">ایتالیایی</option>' +
                    '<option value = "spanish">اسپانیایی</option>' +
                    '<option value = "russian">روسی</option>' +
                    '<option value = "chienese">چینی</option>' +
                    '<option value = "japanese">ژاپنی</option>' +
                    '<option value = "korean">کره ای</option>' +
                    '</select>' +
                    '<select name="languages[][level]" class="education-field form-control">' +
                    '<option value="" selected disabled>سطح زبان</option>' +
                    '<option value="elementary">مقدماتی</option>' +
                    '<option value="intermediate">متوسط</option>' +
                    '<option value="advanced">پیشرفته</option>' +
                    ' </select>' +
                    '<button type="button" class="add-attirbute-btn btn btn-success" disabled>اضافه کردن</button>' +
                    '</div>';
                $('#languageContainer').append(newSkillInput);
            });

            $('#languageContainer').on('click', '.remove-attribute-btn', function() {
                $(this).closest('.education-input').remove();
            });
        } );

        $(document).ready( function() {
            // Disable the button by default
            $('.add-attirbute-btn').prop('disabled', true);

            $('#skillContainer').on('input', '.education-degree, .education-field', function() {
                // Check if both fields have values
                var degreeVal = $(this).closest('.education-input').find('.education-degree').val().trim();
                var levelVal = $(this).closest('.education-input').find('.education-field').val().trim();

                // Enable or disable the button based on the fields' values
                if (degreeVal !== '' && levelVal !== '') {
                    $(this).closest('.education-input').find('.add-attirbute-btn').prop('disabled', false);
                } else {
                    $(this).closest('.education-input').find('.add-attirbute-btn').prop('disabled', true);
                }
            });

            $('#skillContainer').on('click', '.add-attirbute-btn', function() {
                var $btn = $(this);

                // Change the button text to "حذف کردن"
                $btn.text('حذف کردن').addClass('remove-attribute-btn').removeClass('add-attirbute-btn');

                // Append a new skill input field with appropriate distance
                var newSkillInput = '<div class="mt-3 education-input">' + // Adding margin top for appropriate distance
                    '<input type="text" name="skills[][title]" class="education-degree form-control" placeholder="نوع مهارت">' +
                    '<select name="skills[][level]" class="education-field form-control">' +
                    '<option value="" selected disabled>سطح مهارت</option>' +
                    '<option value="elementary">مقدماتی</option>' +
                    '<option value="intermediate">متوسط</option>' +
                    '<option value="advanced">پیشرفته</option>' +
                    ' </select>' +
                    '<button type="button" class="add-attirbute-btn btn btn-success" disabled>اضافه کردن</button>' +
                    '</div>';
                $('#skillContainer').append(newSkillInput);
            });

            $('#skillContainer').on('click', '.remove-attribute-btn', function() {
                $(this).closest('.education-input').remove();
            });
        } );
    </script>
</body>
</html>
