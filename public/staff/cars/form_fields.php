<!-- Make -->
<div class="form_box form_box_options">
    <h4>Make</h4>
    <select class="drop_down <?php if (has_errors($car->errors, 'make')) echo 'error'; ?>" name="car[make]">
        <option selected disabled value="">Select make</option>
        <?php foreach ($makes as $option_name) { ?>
            <?php if ($option_name == $car->make) { ?>
                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
            <?php } else {?>
                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
    <?php echo display_inline_errors($car->errors, 'make'); // Error message ?>
</div>

<!-- Model -->
<div class="form_box">
    <h4>Model</h4>
    <input class="text_field <?php if (has_errors($car->errors, 'model')) echo 'error'; ?>" type="text" id="model" name="car[model]" value="<?php echo h($car->model); ?>" placeholder="Enter model name">
    <?php echo display_inline_errors($car->errors, 'model'); ?>
</div>

<!-- Year -->
<div class="form_box form_box_options">
    <h4>Year</h4>
    <select class="drop_down <?php if (has_errors($car->errors, 'year')) echo 'error'; ?>" name="car[year]">
        <option selected disabled value="">Select year</option>
        <?php foreach (Car::year_options() as $option_name) { ?>
            <?php if ($option_name == $car->year) { ?>
                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
            <?php } else {?>
                <option value="<?php echo $option_name; ?>"><?php echo $option_name; // Error message ?></option>
            <?php } ?>
        <?php } ?>
    </select>
    <?php echo display_inline_errors($car->errors, 'year'); ?>
</div>

<!-- Body Type -->
<div class="form_box form_box_options">
    <h4>Body Type</h4>
    <select class="drop_down <?php if (has_errors($car->errors, 'body_type')) echo 'error'; ?>" name="car[body_type]" id="body_type">
        <option selected disabled value="">Select body type</option>
        <?php foreach ($bodys as $option_name) { ?>
            <?php if ($option_name == $car->body_type) { ?>
                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
            <?php } else {?>
                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
    <?php echo display_inline_errors($car->errors, 'body_type'); // Error message ?>
</div>

<!-- Colour -->
<div class="form_box form_box_options">
    <h4>Colour</h4>
    <select class="drop_down <?php if (has_errors($car->errors, 'colour')) echo 'error'; ?>" name="car[colour]" id="colour">
        <option selected disabled value="">Select colour</option>
        <?php foreach ($colours as $option_name) { ?>
            <?php if ($option_name == $car->colour) { ?>
                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
            <?php } else {?>
                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
    <?php echo display_inline_errors($car->errors, 'colour'); // Error message ?>
</div>

<!-- Mileage -->
<div class="form_box">
    <h4>Mileage (km)</h4>
    <input class="text_field <?php if (has_errors($car->errors, 'mileage_km')) echo 'error'; ?>" type="number" step="1" id="mileage" name="car[mileage_km]" value="<?php echo h($car->mileage_km); ?>" placeholder="Enter mileage in km">
    <small>Mileage will be rounded to nearest whole number.</small>
    <?php echo display_inline_errors($car->errors, 'mileage_km'); // Error message ?>
</div>

<!-- Price -->
<div class="form_box">
    <h4>Price ($)</h4>
    <input class="text_field <?php if (has_errors($car->errors, 'price')) echo 'error'; ?>" type="number" step="1" id="price" name="car[price]" value="<?php echo h($car->price); ?>" placeholder="Enter price in CAD">
    <small>Price will be rounded to nearest whole number.</small>
    <?php echo display_inline_errors($car->errors, 'price'); // Error message ?>
</div>

<!-- Fuel Type -->
<div class="form_box form_box_options">
    <h4>Fuel Type</h4>
    <select class="drop_down <?php if (has_errors($car->errors, 'fuel_type')) echo 'error'; ?>" name="car[fuel_type]">
        <option selected disabled value="">Select fuel type</option>
        <?php foreach (Car::FUEL_OPTIONS as $option_name) { ?>
            <?php if ($option_name == $car->fuel_type) { ?>
                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
            <?php } else {?>
                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
    <?php echo display_inline_errors($car->errors, 'fuel_type'); // Error message ?>
</div>

<!-- Condition -->
<div class="form_box form_box_options">
    <h4>Condition</h4>
    <select class="drop_down <?php if (has_errors($car->errors, 'condition_id')) echo 'error'; ?>" name="car[condition_id]">
        <option selected disabled value="">Select condition</option>
        <?php foreach (Car::CONDITION_OPTIONS as $option_id => $option_name) { ?>
            <?php if ($option_id == $car->condition_id) { ?>
                <option selected value="<?php echo $option_id; ?>"><?php echo $option_name; ?></option>
            <?php } else {?>
                <option value="<?php echo $option_id; ?>"><?php echo $option_name; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
    <?php echo display_inline_errors($car->errors, 'condition_id'); // Error message ?>
</div>

<!-- Description -->
<div class="form_box description_box">
    <h4>Description</h4>
    <textarea class="text_field description_text <?php if (has_errors($car->errors, 'description')) echo 'error'; ?>" type="text" id="description" name="car[description]" placeholder="Enter brief vehicle description"><?php echo h($car->description); ?></textarea>
    <?php echo display_inline_errors($car->errors, 'description'); // Error message ?>
</div>

<!-- Image -->
<div class="form_box image_box">
    <h4>Image</h4>
    <div class="image_display" style="<?php if (empty($car->image)) echo 'display: none;'; ?>">
        <img id="image_preview" alt="Image preview" src="../../<?php echo h($car->image())?>">
        <span id="image_name"><?php echo h($car->image); ?></span>
    </div>
    <label for="image" class="image_button <?php if (has_errors($car->errors, 'image')) echo 'error_image'; ?>">
        <input class="text_field image_button" type="file" id="image" name="image" accept=".jpg, .jpeg, .png">
        <p><i class="bi bi-upload"></i>Upload Image</p>
        <small style="font-weight: normal;">jpg, jpeg, png</small>
    </label>
    <?php echo display_inline_errors($car->errors, 'image'); // Error message ?>
</div>