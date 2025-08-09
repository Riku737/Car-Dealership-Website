<?php require_once('../../..//private/initialize.php');?>

<?php 

$id = $_GET['id'] ?? false;

if (!$id) {

    redirect_to('index.php');

}

$car = Car::find_by_id($id);

?>

<?php include(SHARED_PATH . '/staff_navigation.php'); ?>

<div class="website_content">

    <section class="section_container">
    
        <div class="section_content">

            <div class="heading_container">
                <div class="breadcrumb_menu">
                    <a class="link" href="<?php echo url_for('/staff/index.php'); ?>">Staff</a>
                    <p>/</p>
                    <a class="link" href="<?php echo url_for('/staff/cars/index.php'); ?>">Inventory</a>
                    <p>/</p>
                    <p><?php echo h($car->name()) ?></p>
                </div>
                <h1>Edit <?php echo h($car->name()); ?></h1>
            </div>

            <form class="form_container">
                
                <div class="form_box">
                    <h4>Make</h4>
                    <select class="drop_down" name="make">
                        <?php foreach ($makes as $option_name) { ?>
                            <?php if ($option_name == $car->make) { ?>
                                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Model</h4>
                    <input class="text_field" type="text" id="model" name="model" value="<?php echo h($car->model); ?>" placeholder="Enter model name">
                </div>

                <div class="form_box">
                    <h4>Year</h4>
                    <input class="text_field" type="text" id="year" name="year" value="<?php echo h($car->year); ?>" maxlength="4" placeholder="Enter year in YYYY format">
                </div>

                <div class="form_box">
                    <h4>Body Type</h4>
                    <select class="drop_down" name="body_type" id="body_type">
                        <?php foreach ($bodys as $option_name) { ?>
                            <?php if ($option_name == $car->body_type) { ?>
                                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Colour</h4>
                    <select class="drop_down" name="colour" id="colour">
                        <?php foreach ($colours as $option_name) { ?>
                            <?php if ($option_name == $car->colour) { ?>
                                <option selected value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_name; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box">
                    <h4>Mileage (km)</h4>
                    <input class="text_field" type="text" id="mileage" name="mileage" value="<?php echo h($car->mileage_km); ?>" placeholder="Enter mileage in km">
                    <small>Mileage will be rounded to nearest whole number.</small>
                </div>

                <div class="form_box">
                    <h4>Price ($)</h4>
                    <input class="text_field" type="text" id="price" name="price" value="<?php echo h($car->price); ?>" placeholder="Enter price in CAD">
                    <small>Price will be rounded to nearest whole number.</small>
                </div>

                <div class="form_box">
                    <h4>Condition</h4>
                    <select class="drop_down" name="condition_id" id="condition_id">
                        <?php foreach (Car::CONDITION_OPTIONS as $option_id => $option_name) { ?>
                            <?php if ($option_id == $car->condition_id) { ?>
                                <option selected value="<?php echo $option_id; ?>"><?php echo $option_name; ?></option>
                            <?php } else {?>
                                <option value="<?php echo $option_id; ?>"><?php echo $option_name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form_box description_box">
                    <h4>Description</h4>
                    <textarea class="text_field description_text" type="text" id="description" name="description" placeholder="Enter brief vehicle description"><?php echo h($car->description); ?></textarea>
                </div>

                <div class="form_buttons">
                    <button type="submit" class="primary_button">Save changes</button>
                    <a href="<?php echo url_for('/staff/cars/index.php')?>" class="tertiary_button">Cancel</a>
                </div>


            </form>

        </div>

    </section>

</div>


<?php include(SHARED_PATH . '/public_footer.php'); ?>