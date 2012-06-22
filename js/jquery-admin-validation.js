$(document).ready(function()
{
$('#location_event').click(function()
{
if($(this).is(':checked'))
{
$('#country_name').val('');
$('#country').val('');
$("#country_name").attr("disabled", "disabled");

$('#state_name').val('');
$('#state').val('');
$("#state_name").attr("disabled", "disabled");

$('#city_name').val('');
$('#city').val('');
$("#city_name").attr("disabled", "disabled");

$('#add_country').hide();
$('#add_state').hide();
$('#add_city').hide();					
}
else
{
$("#country_name").removeAttr("disabled"); 
$('#add_country').show();
$('#add_state').show();
$('#add_city').show();
}
});
})  
