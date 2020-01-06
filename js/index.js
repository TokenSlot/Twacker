$(document).ready(function() {
    $("#twack-form").submit(function (e) {
        e.preventDefault();
        if ($('.upload-file')[0].files.length !== 0) {
            var file_data = $('.upload-file').prop('files')[0];

            var image_name = file_data.name;
            var image_extension = image_name.split('.').pop().toLowerCase();

            if(jQuery.inArray(image_extension,["gif","png","jpeg","jpg","mp4"]) == -1){
                alert("Invalid file type");
            } else {
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.ajax({
                    url: 'upload_file.php',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success:function(result){
                        var returned = result;
                        send_twack(returned);

                    },
                });
            }
        } else {
            send_twack();
        }

    });
});

$(document).ready(function() {

    $("#comment-form").submit(function (e) {
        e.preventDefault();
        if ($('.upload-file')[0].files.length !== 0) {
            var file_data = $('.upload-file').prop('files')[0];

            var image_name = file_data.name;
            var image_extension = image_name.split('.').pop().toLowerCase();

            if(jQuery.inArray(image_extension,["gif","png","jpeg","jpg","mp4"]) == -1){
                alert("Invalid file type");
            } else {
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.ajax({
                    url: 'upload_file.php',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success:function(result){
                        var returned = result;
                        create_comment(returned);

                    },
                });
            }
        } else {
            create_comment();
        }

    });
});

$('#createTwackModal').on('hidden.bs.modal', function (e) {
    $("#twackarea").val('');
    $('.img-vid').removeClass('d-none');
    $('#upload-div').addClass('d-none');
    $('.upload-file').val(null);
    $('.upload-file').next('.custom-file-label').html("Choose file");
});

$(".img-vid").on("click", function () {
    $(".img-vid").addClass('d-none');
    $('#upload-div').removeClass('d-none');
    $('.upload-file').trigger('click');
});

$( window ).resize(function() {
    $('.dropdown-menu').removeClass('show');
});

$(window).scroll(function (event) {
    var nav_size = $('nav').outerHeight();
    var scroll = $(window).scrollTop();
    if (scroll > 100) {
        $('#side-nav').css("padding-top", nav_size);
    } else {
        $('#side-nav').css("padding-top", 0);
    }
});

function send_twack() {
    var twack = $("#twackarea").val();
    $.post("create_twack.php", {
        twack: twack
    }, function(result) {
        if (location.pathname !== "/twacker/index.php") {
            location.href="comments.php?twack_id="+result;
        }
        $('.modal').removeClass('in');
        $('.modal').attr("aria-hidden","true");
        $('.modal').css("display", "none");
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $("#twacks").load("twacks.php");
    });
}

function create_comment() {
    var twack = $("#comment").val();
    var twack_id = $("#comment").attr("name");
    $.post("create_comment.php", {
        twack: twack,
        twack_id: twack_id
    }, function() {
        $("#comment").val('');
        $('.img-vid').removeClass('d-none');
        $('#upload-div').addClass('d-none');
        $('.upload-file').val(null);
        $('.upload-file').next('.custom-file-label').html("Choose file");
        $("#comments-section").load("comments_section.php?twack_link="+twack_id);
    });
}

function send_twack(filename) {
    var twack = $("#twackarea").val();
    $.post("create_twack.php", {
        twack: twack,
        filename: filename
    }, function(result) {
        if (location.pathname !== "/twacker/index.php") {
            location.href="comments.php?twack_id="+result;
        }
        $('.modal').removeClass('in');
        $('.modal').attr("aria-hidden","true");
        $('.modal').css("display", "none");
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $("#twacks").load("twacks.php");
    });
}

function create_comment(filename) {
    var twack = $("#comment").val();
    var twack_id = $("#comment").attr("name");
    $.post("create_comment.php", {
        twack: twack,
        twack_id: twack_id,
        filename: filename
    }, function() {
        $("#comment").val('');
        $('.img-vid').removeClass('d-none');
        $('#upload-div').addClass('d-none');
        $('.upload-file').val(null);
        $('.upload-file').next('.custom-file-label').html("Choose file");
        $("#comments-section").load("comments_section.php?twack_link="+twack_id);
    });
}


function confirm_delete() {
    return confirm('Do you really want to delete?');
}

$(document).on('show.bs.modal', '.modal', function () {
    if ($(".modal-backdrop").length > 1) {
        $(".modal-backdrop").not(':first').remove();
    }
});

$( document ).ajaxStart(function() {
    //$("#twacks").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>')
});

$( document ).ajaxStop(function() {

});

function delete_twack(id) {
    if (confirm("Are you sure you want to delete?")) {
        $.get("deletetwack.php", {
            id: id
        }, function()  {
            $("#twacks").load("twacks.php");
            var twack_id = $("#comment").attr("name");
            $("#comments-section").load("comments_section.php?twack_link="+twack_id);
            $("#twack").load("twack.php?twack_id="+twack_id);
        })
    }
}

function edit_twack(id) {
    if (confirm("Are you sure you want to edit?")) {
        var twack = $("#edit-twackarea").val();

        $.get("edit_twack.php", {
            twack: twack,
            id: id
        }, function()  {
            $('.modal').removeClass('in');
            $('.modal').attr("aria-hidden","true");
            $('.modal').css("display", "none");
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $("#twacks").load("twacks.php");
            var twack_id = $("#comment").attr("name");
            $("#comments-section").load("comments_section.php?twack_link="+twack_id);
            $("#twack").load("twack.php?twack_id="+twack_id);
        })
    }
}

function show_edit_modal(id) {
    edit_value = id;
    var text = $('#p-text-'+id).text();
    $('#twackEditbtn').attr('onClick', "edit_twack("+id+")");
    $("#edit-twackarea").val(text);
}

function vote(twack_id, vote_count) {
    $.post("vote.php", {
        twack_id: twack_id,
        vote_count: vote_count
    }, function() {
        $("#votes-" + twack_id).load("votes.php", {
            twack_id: twack_id
        });
    })
}

$('.upload-file').on('change',function(){
    var path = $(this).val();
    var fileName = path.split('\\').pop().split('/').pop();
    $(this).next('.custom-file-label').html(fileName);
    if ($('.upload-file')[0].files.length !== 0) {
        $('#twackarea').removeAttr('required');
    }
})
