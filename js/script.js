$(document).ready(function () {   
    var options = {
        dataType: 'json',
        processData: false,
        error: displayError,
        success: displayVideo,
        uploadProgress: displayProgress,
        resetForm: true,
        clearForm: true
    }
    
    $('#create-video').submit(function() { 
        $(this).ajaxSubmit(options); 
        return false;
    });
    
    $('#reset').click(function() { 
        $('#create-video').clearForm();
    });    
});

function displayError(data){
    if(data.title_error){
        $('#messages').append(data.title_error);
    }else if(data.file_error){
        $('#messages').append(data.file_error);
    }
    $('#messages').slideDown();
}

function displayVideo(data){
    if(data.title_error){
        $('#messages').html(data.title_error);
    }else if(data.file_error){
        $('#messages').html(data.file_error);
    }
    
    if(data.video && !('file_error' in data || 'title_error' in data)){
        $('#messages').html(data.title);
        $('#video').html(data.video);
    }
    $('#messages').slideDown();
}

function displayProgress(event, position, total, percentComplete){
    $('#messages').html('Processing: '+percentComplete+'%');
    $('#messages').slideDown();
}
