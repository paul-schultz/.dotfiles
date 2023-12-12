<?php

function toCamelCase($string, $toPascalCase = false)
{
  $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
  if (!$toPascalCase) {
    $str[0] = strtolower($str[0]);
  }
  return $str;
}

function toSnakeCase($string)
{
  return str_replace('-', '_', $string);
}

function toEnglish($string)
{
  return ucwords(implode(' ', preg_split('/(?=[A-Z])/', $string)));
}

$file_name = $argv[1];

if (!is_null(strpos($file_name, '-'))) {
  $kebab_case  = $file_name;
  $camel_case  = toCamelCase($file_name);
  $pascal_case = toCamelCase($file_name, true);
  $snake_case  = toSnakeCase($file_name);
  $in_english  = toEnglish($camel_case);
}

$file_path = './' . $kebab_case . '.php';

if (file_exists($file_path)) {
  echo 'File with the name ' . $file_name . '.php already exists!';
  exit;
} else {
  $file = fopen($file_path, 'w') or die('Unable to open file!');
}

$file_contents = "<?php

// create the file: " . $kebab_case . ".php
// inside of wp-content/themes/WestCoastUniversity-WP-Theme/inc/acf-fields/flexible-components
// and paste lines 8 - 22 into it
?>

<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

require_once dirname(__FILE__) . '/../utils/background-color.php';

function make" . $pascal_case . "()
{
  \$backgroundColorUtility = makeBackgroundColorUtility();

  \$" . $camel_case . " = new FieldsBuilder('" . $snake_case . "');
  \$" . $camel_case . "
    ->addFields(\$backgroundColorUtility);
    ->addText('test')
    // add acf fields here 
  ;

  return \$" . $camel_case . ";
}

?>

<?php
// in the desired acf template file, paste these lines 
// acf template files are located in wp-content/themes/WestCoastUniversity-WP-Theme/inc/acf-fields

require_once dirname(__FILE__) . '/flexible-components/" . $kebab_case . ".php';

\$" . $camel_case . " = make" . $pascal_case . "();

// add to flexible content section
->addLayout('" . $snake_case . "')
->addFields(\$" . $camel_case . ")


?>

<?php
// create the file: " . $kebab_case . ".php
// inside of wp-content/themes/WestCoastUniversity-WP-Theme/template-parts/partials if the component will be flexible content
// or wp-content/themes/WestCoastUniversity-WP-Theme/template-parts if it will be a layout
// and paste lines 48 - 66 into it
?>

<?php

// Template Part - " . $in_english . "

?>

<?php
// example acf field
// \$test = get_sub_field('test');
\$background_color = get_sub_field('background_color');
\$test             = '" . $in_english . " Test';
?>

<section class=\"" . $kebab_case . '-section <?= $background_color ?>' . "\">
  <div class=\"container\">
    <div class=\"content\">    
      <?= \$test ?>  
    </div>
  </div>
</section>

<?php
// in the desired wordpress template file (with the same name as the acf template file), paste these lines 
// the default theme is wp-content/themes/WestCoastUniversity-WP-Theme/page.php
// other wordpress template files are located in wp-content/themes/WestCoastUniversity-WP-Theme/page-templates

// if the component will be flexible content add the following in the flexible content else/if block
elseif( get_row_layout() == '" . $snake_case . "' ):
  get_template_part('template-parts/partials/" . $kebab_case . "');


// otherwise use
?>
<?php get_template_part( 'template-parts/partials/hero' ); ?>

// create the file: _" . $kebab_case . ".scss
// inside of an appropriate subdirectory inside wp-content/themes/WestCoastUniversity-WP-Theme/assets/scss
// and paste lines 131 - 139 into it
// dont forget to include the new file in wp-content/themes/WestCoastUniversity-WP-Theme/assets/scss/styles.scss

// " . $in_english . " Section

." . $kebab_case . "-section {
  .container {
    .content {

    }
  }
}
";

fwrite($file, $file_contents);
fclose($file);
