<?php

// create the file: upcoming-events.php
// inside of wp-content/themes/WestCoastUniversity-WP-Theme/inc/acf-fields/flexible-components
// and paste lines 8 - 22 into it
?>

<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

require_once dirname(__FILE__) . '/../utils/background-color.php';

function makeUpcomingEvents()
{
  $backgroundColorUtility = makeBackgroundColorUtility();

  $upcomingEvents = new FieldsBuilder('upcoming_events');
  $upcomingEvents
    ->addFields($backgroundColorUtility);
    ->addText('test')
    // add acf fields here 
  ;

  return $upcomingEvents;
}

?>

<?php
// in the desired acf template file, paste these lines 
// acf template files are located in wp-content/themes/WestCoastUniversity-WP-Theme/inc/acf-fields

require_once dirname(__FILE__) . '/flexible-components/upcoming-events.php';

$upcomingEvents = makeUpcomingEvents();

// add to flexible content section
->addLayout('upcoming_events')
->addFields($upcomingEvents)


?>

<?php
// create the file: upcoming-events.php
// inside of wp-content/themes/WestCoastUniversity-WP-Theme/template-parts/partials if the component will be flexible content
// or wp-content/themes/WestCoastUniversity-WP-Theme/template-parts if it will be a layout
// and paste lines 48 - 66 into it
?>

<?php

// Template Part - Upcoming Events

?>

<?php
// example acf field
// $test = get_sub_field('test');
$background_color = get_sub_field('background_color');
$test             = 'Upcoming Events Test';
?>

<section class="upcoming-events-section <?= $background_color ?>">
  <div class="container">
    <div class="content">    
      <?= $test ?>  
    </div>
  </div>
</section>

<?php
// in the desired wordpress template file (with the same name as the acf template file), paste these lines 
// the default theme is wp-content/themes/WestCoastUniversity-WP-Theme/page.php
// other wordpress template files are located in wp-content/themes/WestCoastUniversity-WP-Theme/page-templates

// if the component will be flexible content add the following in the flexible content else/if block
elseif( get_row_layout() == 'upcoming_events' ):
  get_template_part('template-parts/partials/upcoming-events');


// otherwise use
?>
<?php get_template_part( 'template-parts/partials/hero' ); ?>

// create the file: _upcoming-events.scss
// inside of an appropriate subdirectory inside wp-content/themes/WestCoastUniversity-WP-Theme/assets/scss
// and paste lines 131 - 139 into it

// Upcoming Events Section

.upcoming-events-section {
  .container {
    .content {

    }
  }
}
