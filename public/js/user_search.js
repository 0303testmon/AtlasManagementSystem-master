$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
    /* 20241015 add >> */
    $(this).toggleClass('is-open');
    $(this).siblings('.subject_inner').toggleClass('is-open');
    /* 20241015 add << */
  });

  /* 20241016 add >> */
  $('.search_conditions_btn').click(function () {
    $('.search_conditions_inner').slideToggle();
    $(this).toggleClass('is-open');
    $(this).siblings('.search_conditions_inner').toggleClass('is-open');
    /* 20241016 add << */
  });



});
