$(document).ready(function(){

//Function Definitions
function getDropdowns(){
$('.people_id_list').append(function(){
    $.ajax({
      type: 'GET',
      url: 'API/people',
      dataType: 'json',
      success: function(response){
        var len = response.length;
        $('.people_id_list').empty();
        for(var i=0; i<len; i++){
          var id = response[i]['id_p'];
          var fname = response[i]['first_name'];
          var lname = response[i]['last_name'];
          $('.people_id_list').append("<option value='"+id+"' name='"+id+"' id='"+fname+"'>"+fname+ " "+lname+"</option>");
        }

      },
      error: function(response){
        console.log('error');
      }
});
});
$('.people_id_list_add').append(function(){
    $.ajax({
      type: 'GET',
      url: 'API/people',
      dataType: 'json',
      success: function(response){
        var len = response.length;
        $('.people_id_list_add').empty();
        for(var i=0; i<len; i++){
          var id = response[i]['id_p'];
          var fname = response[i]['first_name'];
          var lname = response[i]['last_name'];
          $('.people_id_list_add').append("<option value='"+id+"'' id='"+id+"'>"+fname+ " "+lname+"</option>");
        }
      },
      error: function(response){
        console.log('error');
      }
});
});
}

function displayHide(){
  $('#display_success').hide();
}

function displayShow(item){
  $('#display_success').show(function(){
      $('#display_success').empty().fadeIn().append("<div class='alert alert-success'><h6>A new "+item+" has been added</h6></div>").fadeOut(2000);
  });
}

function displayData(){
var user_id = $('.people_id_list').val();
$.ajax({
  type: 'GET',
  url: 'API/visits/'+user_id,
  dataType: "json",
  success: function(response){
    $('.display_info').empty();
    $('.display_visits').empty();
    var len_p = response.length;
    if(len_p>0){
    var fname = response[0]['first_name'];
    var lname = response[0]['last_name'];
    var food = response[0]['fav_food'];
    $('.display_info').append("<h6><code>"+fname+" "+lname+"</code> likes to eat <code>"+food+"</code></h6>");
    $('.display_visits').append("<table class='table table-bordered' id='table_visits'></table>");
    $('#table_visits').append("<tr><th>First</th><th>Last</th><th>State</th><th>Date</th></tr>")
    for(i=0; i<len_p; i++){
    var date = response[i]['date_id'];
    var state = response[i]['state_name'];
    $('#table_visits').append("<tr><td><code>"+fname+"</code></td><td><code>"+lname+"</code></td><td> has visited <code>"+state+"</code></td> on <td><code>"+date+"</code></td></tr>");
  }
  }
  else{
    $.ajax({
      type: 'GET',
      url: 'API/people/'+user_id,
      dataType: "json",
      success: function(response){
        $('.display_info').empty();
        $('.display_visits').empty();
        var fname = response[0]['first_name'];
        var lname = response[0]['last_name'];
        var food = response[0]['fav_food'];
        $('.display_info').append("<h6><code>"+fname+" "+lname+"</code> likes to eat <code>"+food+"</code></h6>");
        $('.display_info').append("<h6><code>"+fname+" "+lname+"</code> has never traveled. </h6>");
      }
  });
  }
}
});
}

function displayStates(){
  $.ajax({
    type: 'GET',
    url: 'API/states',
    dataType: "json",
    success: function(response){
      var len = response.length;
      $('.state_id_list').empty();
      for(var s_i=0; s_i<len; s_i++ ){
        var s_id = response[s_i]['id_s'];
        var s_abb = response[s_i]['state_abb'];
        var s_name = response[s_i]['state_name'];
        $('.state_id_list').append("<option value='"+s_id+"'' name='"+s_id+"'>"+s_abb+ " - "+s_name+"</option>");
      }
    }
});
}

//Initial Function Calls
getDropdowns();
displayHide();
displayData();


//Populate Person Information
$('.people_id_list').change(function(){
  displayData();
});

//Populate States
$('.state_id_list').append(function(){
  displayStates();
});


//Add Visit
$('.visit_btn').click(function(event){
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'API/visits',
      data: $('.visit_form').serialize(),
      success: function(){
        getDropdowns();
        displayShow("visit");
        displayData();
      }
});
});

//Add Person
$('.person_btn').click(function(event){
      event.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'API/people',
        data: $('.person_frm').serialize(),
        success: function(){
          getDropdowns();
          displayShow("person");
          displayData();
      }
});
});
});
