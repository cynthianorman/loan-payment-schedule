<?php

/*
 * Template Name: Loan Payment Schedule
 * Version: 2.0
 * Description: A Gravity PDF print-friendly template focusing solely on the user-submitted data. Through the Template tab you can control the PDF header and footer, change the background color or image, and show or hide the form title, page names, HTML fields and the Section Break descriptions.
 * Author: Cynthia Norman
 * Author URI: https://github.com/candevelops
 * License: GPLv2
 * Required PDF Version: 4.0-alpha
 * Tags: Header, Footer, Background, Optional HTML Fields, Optional Page Fields
 */

/* Prevent direct access to the template */
if ( ! class_exists( 'GFForms' ) ) {
	return;
}

/*
 * All Gravity PDF 4.x templates have access to the following variables:
 *
 * $form (The current Gravity Form array)
 * $entry (The raw entry data)
 * $form_data (The processed entry data stored in an array)
 * $settings (the current PDF configuration)
 * $fields (an array of Gravity Form fields which can be accessed with their ID number)
 * $config (The initialised template config class – eg. /config/blank-slate.php)
 * $gfpdf (the main Gravity PDF object containing all our helper classes)
 * $args (contains an array of all variables - the ones being described right now - passed to the template)
 */



/*
* Variables
*/


$total = $form_data['field'][15]; /* The string value of the principal */
$rate = $form_data['field'][18]; /* The interest rate */
$frequency = $form_data['field'][19]; /* The payment frequency */
$estpayment = $form_data['field'][21]; /* The string value of the loan payment */
$periodicrate = $form_data['field'][22]; /* The periodic interest rate */
$numberofpayments = $form_data['field'][23]; /* The total number of payments starting the end of period */
$principal = $form_data['field'][29]; /* The number value of the principal */
$payment = $form_data['field'][31]; /* The number value of the payment */

?>

<!-- Include styles needed for the PDF -->
<style>

	/* Handle Gravity Forms CSS Ready Classes */
	.row-separator {
		clear: both;
		padding: 1.25mm 0;
	}

	.gf_left_half,
	.gf_left_third, .gf_middle_third,
	.gf_first_quarter, .gf_second_quarter, .gf_third_quarter,
	.gf_list_2col li, .gf_list_3col li, .gf_list_4col li, .gf_list_5col li {
		float: left;
	}

	.gf_right_half,
	.gf_right_third,
	.gf_fourth_quarter {
		float: right;
	}

	.gf_left_half, .gf_right_half,
	.gf_list_2col li {
		width: 49%;
	}

	.gf_left_third, .gf_middle_third, .gf_right_third,
	.gf_list_3col li {
		width: 32.3%;
	}

	.gf_first_quarter, .gf_second_quarter, .gf_third_quarter, .gf_fourth_quarter {
		width: 24%;
	}

	.gf_list_4col li {
		width: 24%;
	}

	.gf_list_5col li {
		width: 19%;
	}

	.gf_left_half, .gf_right_half {
		padding-right: 1%;
	}

	.gf_left_third, .gf_middle_third, .gf_right_third {
		padding-right: 1.505%;
	}

	.gf_first_quarter, .gf_second_quarter, .gf_third_quarter, .gf_fourth_quarter {
		padding-right: 1.333%;
	}

	.gf_right_half, .gf_right_third, .gf_fourth_quarter {
		padding-right: 0;
	}

	/* Don't double float the list items if already floated (mPDF does not support this ) */
	.gf_left_half li, .gf_right_half li,
	.gf_left_third li, .gf_middle_third li, .gf_right_third li {
		width: 100% !important;
		float: none !important;
	}

	/*
	 * Headings
	 */
	h3 {
		margin: 1.5mm 0 0.5mm;
		padding: 0;
	}

	/*
	 * Quiz Style Support
	 */
	.gquiz-field {
		color: #666;
	}

	.gquiz-correct-choice {
		font-weight: bold;
		color: black;
	}

	.gf-quiz-img {
		padding-left: 5px !important;
		vertical-align: middle;
	}

	/*
	 * Survey Style Support
	 */
	.gsurvey-likert-choice-label {
		padding: 4px;
	}

	.gsurvey-likert-choice, .gsurvey-likert-choice-label {
		text-align: center;
	}

	/*
	 * Terms of Service (Gravity Perks) Support
	 */
	.terms-of-service-agreement {
		padding-top: 2px;
		font-weight: bold;
	}

	.terms-of-service-tick {
		font-size: 150%;
	}

	/*
	 * List Support
	 */
	ul, ol {
		margin: 0;
		padding-left: 1mm;
		padding-right: 1mm;
	}

	li {
		margin: 0;
		padding: 0;
		list-style-position: inside;
	}

	/*
	 * Header / Footer
	 */
	.alignleft {
		float: left;
	}

	.alignright {
		float: right;
	}

	.aligncenter {
		text-align: center;
	}

	p.alignleft {
		text-align: left;
		float: none;
	}

	p.alignright {
		text-align: right;
		float: none;
	}

	/*
	 * Independant Template Styles
	 */
	.row-separator .gfpdf-field {
		margin-bottom: 10px;
	}

	#form_title {
		margin: 0;
		font-size: 150%;
	}

	.product-field-title {
		margin: 0;
	}

	.gfpdf-field .label {
	   padding-bottom: 5px;
	}

	.gfpdf-field .value {

	}

	.gfield_list th, table.entry-products td.emptycell, table.entry-products th {
		background: none;
	}

	/* 
	* My CSS 
	*/

	.separator-orange {
  		height: 20px;
		margin: 10px 0px;  
  		background-color: red;
  		background-image:
    		linear-gradient(
	   		red, #f06d06
    	);
}

</style>

<!-- Output the custom HTML and PHP from developer Cynthia Norman -->
<!-- Email your questions to info@cynthianorman.com -->

<?php if ( $frequency === '52'  ): 
    	$frequencypdf = "Weekly";
	elseif ( $frequency === '26' ):
		$frequencypdf = "Bi-Weekly";
	elseif ( $frequency === '24' ):
		$frequencypdf = "Semi-Monthly";
	elseif ( $frequency === '12' ):
		$frequencypdf = "Monthly";
		else:
    $frequencypdf = "Unknown";
		endif; ?>


<h1>EPIC Financial Loan Schedule of Payments</h1>
<p>Please allow for slight rounding differences</p>
<p>Here are some things to keep in mind</p>
<ul>
<li>While your loan payment stays the same each period</li>
<li>The composition changes over time as the outstanding balance falls</li>
<li>Early on in the loan term most of the payment is interest</li>
<li>And late in the term it’s mostly principal that you’re paying back</li>

<h2>Summary of Loan</h2>

<h3>Principal: $ <?= number_format($principal, 2) ?> CAD</h3>
<h3>Interest Rate: <?= $rate ?>%</h3>
<h3>Payment Frequency: <?= $frequencypdf ?></h3>
<h3>Number of Payments: <?= $numberofpayments ?></h3>
<h3>Payment: <?= $estpayment ?></h3>

<div class="separator-orange"></div>

<div class="gf_first_quarter"><h3>Payment Period</h3></div>
<div class="gf_second_quarter"><h3>Interest Amount</h3></div>
<div class="gf_third_quarter"><h3>Principal Amount</h3></div>
<div class="gf_fourth_quarter"><h3>Balance Owing</h3></div>

<?php

$i = 1;
$fromprincipal = $principal;
$balance = $principal;
while ($i <= $numberofpayments) {?>
	
	<div class="gf_first_quarter"><?= $i; ?></div>

	<?php
	$interest = $balance * ((1 + $periodicrate) - 1);
	$interestpdf = number_format($interest, 2);?>

	<div class="gf_third_quarter"><?= $interestpdf; ?></div>

	<?php	
	$fromprincipal = $payment - $interest;
	$fromprincipalpdf = number_format($fromprincipal, 2);?>

	<div class="gf_second_quarter"><?= $fromprincipalpdf; ?></div>

	<?php
	$balance = $balance - $fromprincipal;
	$balancepdf = number_format($balance, 2);?>

	<div class="gf_fourth_quarter"><?= $balancepdf; ?></div>

	<br/>
	<?php $i++;
}?>

<?php

/*
 * Load our core-specific styles from our PDF settings which will be passed to the PDF template $config array
 */
$show_form_title      = ( ! empty( $settings['show_form_title'] ) && $settings['show_form_title'] === 'Yes' ) ? true : false;
$show_page_names      = ( ! empty( $settings['show_page_names'] ) && $settings['show_page_names'] === 'Yes' ) ? true : false;
$show_html            = ( ! empty( $settings['show_html'] ) && $settings['show_html'] === 'Yes' ) ? true : false;
$show_section_content = ( ! empty( $settings['show_section_content'] ) && $settings['show_section_content'] === 'Yes' ) ? true : false;
$enable_conditional   = ( ! empty( $settings['enable_conditional'] ) && $settings['enable_conditional'] === 'Yes' ) ? true : false;
$show_empty           = ( ! empty( $settings['show_empty'] ) && $settings['show_empty'] === 'Yes' ) ? true : false;

/**
 * Set up our configuration array to control what is and is not shown in the generated PDF
 *
 * @var array
 */
$html_config = array(
	'settings' => $settings,
	'meta'     => array(
		'echo'                     => true, /* whether to output the HTML or return it */
		'exclude'                  => true, /* whether we should exclude fields with a CSS value of 'exclude'. Default to true */
		'empty'                    => $show_empty, /* whether to show empty fields or not. Default is false */
		'conditional'              => $enable_conditional, /* whether we should skip fields hidden with conditional logic. Default to true. */
		'show_title'               => $show_form_title, /* whether we should show the form title. Default to true */
		'section_content'          => $show_section_content, /* whether we should include a section breaks content. Default to false */
		'page_names'               => $show_page_names, /* whether we should show the form's page names. Default to false */
		'html_field'               => $show_html, /* whether we should show the form's html fields. Default to false */
		'individual_products'      => false, /* Whether to show individual fields in the entry. Default to false - they are grouped together at the end of the form */
		'enable_css_ready_classes' => true, /* Whether to enable or disable Gravity Forms CSS Ready Class support in your PDF */
	),
);

/*
 * Generate our HTML markup
 *
 * You can access Gravity PDFs common functions and classes through our API wrapper class "GPDFAPI"
 * 
 * $pdf = GPDFAPI::get_pdf_class();
*  $pdf->process_html_structure( $entry, GPDFAPI::get_pdf_class( 'model' ), $html_config );
 */


