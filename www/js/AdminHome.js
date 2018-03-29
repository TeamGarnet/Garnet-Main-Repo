function cancelChanges() {
    $('#updateModal').modal('hide');
    $('#updateModalBody').empty();
}

function deleteGrave(id) {
    $(document).ready(function() {
        $('#deleteModal').modal('show');
        $('.confirm').click(function () {
            $.ajax({
                type: "POST",
                url: "../ajaxCalls.php",
                data: 'deleteGrave=' + String(id) +'&action=delete',
                success: function (data) {
                    $('.deleteModal').modal('hide');
                    return true;
                },
                dataType:"text",
                processData: false,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
}

function deleteNH(id) {
    $(document).ready(function() {
        $('#deleteModal').modal('show');
        $('.confirm').click(function () {
            $.ajax({
                type: "POST",
                url: "../ajaxCalls.php",
                data: 'deleteNH=' + String(id) +'&action=delete',
                success: function (data) {
                    $('.deleteModal').modal('hide');
                    return true;
                },
                dataType:"text",
                processData: false,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
}

function deleteMisc(id) {
    $(document).ready(function() {
        $('#deleteModal').modal('show');
        $('.confirm').click(function () {
            $.ajax({
                type: "POST",
                url: "../ajaxCalls.php",
                data: 'deleteMisc=' + String(id) +'&action=delete',
                success: function (data) {
                    $('.deleteModal').modal('hide');
                    return true;
                },
                dataType:"text",
                processData: false,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
}

function deleteType(id) {
    $(document).ready(function() {
        $('#deleteModal').modal('show');
        $('.confirm').click(function () {
            $.ajax({
                type: "POST",
                url: "../ajaxCalls.php",
                data: 'deleteType=' + String(id) +'&action=delete',
                success: function (data) {
                    $('.deleteModal').modal('hide');
                    //alert(data);
                    if (data != "") {
                        $('.messageContent').html('');
                        $('.messageContent').append(data);
                        $('.message').modal('show');
                    }
                    return true;
                },
                dataType:"text",
                processData: false,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
}

function deleteHistoricFilter(id) {
    $(document).ready(function() {
        $('#deleteModal').modal('show');
        $('.confirm').click(function () {
            $.ajax({
                type: "POST",
                url: "../ajaxCalls.php",
                data: 'deleteHistoricFilter=' + String(id) +'&action=delete',
                success: function (data) {
                    $('.deleteModal').modal('hide');
                    return true;
                },
                dataType:"text",
                processData: false,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
}

function deleteFAQ(id) {
    $(document).ready(function() {
        $('#deleteModal').modal('show');
        $('.confirm').click(function () {
            $.ajax({
                type: "POST",
                url: "../ajaxCalls.php",
                data: 'deleteFAQ=' + String(id) +'&action=delete',
                success: function (data) {
                    $('.deleteModal').modal('hide');
                    return true;
                },
                dataType:"text",
                processData: false,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
}

function deleteLocation(id) {
    $(document).ready(function() {
        $('#deleteModal').modal('show');
        $('.confirm').click(function () {
            $.ajax({
                type: "POST",
                url: "../ajaxCalls.php",
                data: 'deleteLocation=' + String(id) +'&action=delete',
                success: function (data) {
                    $('.deleteModal').modal('hide');
                    return true;
                },
                dataType:"text",
                processData: false,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
}

function deleteContact(id) {
    $(document).ready(function() {
        $('#deleteModal').modal('show');
        $('.confirm').click(function () {
            $.ajax({
                type: "POST",
                url: "../ajaxCalls.php",
                data: 'deleteContact=' + String(id) +'&action=delete',
                success: function (data) {
                    $('.deleteModal').modal('hide');
                    return true;
                },
                dataType:"text",
                processData: false,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
}

function deleteEvent(id) {
    $(document).ready(function() {
        $('#deleteModal').modal('show');
        $('.confirm').click(function () {
            $.ajax({
                type: "POST",
                url: "../ajaxCalls.php",
                data: 'deleteEvent=' + String(id) +'&action=delete',
                success: function (data) {
                    $('.deleteModal').modal('hide');
                    return true;
                },
                dataType:"text",
                processData: false,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
}

function generateForm(tableID, rowID, idHistoricFilter, action) {
    action = action || 'update';
    if(action !== 'update' || action!== 'create') {
        throw new Error('Action should either be "update" or "create"');
    }
    // Grab current table header value and corresponding table data value
    var input = '';
    var tdVal = '';
    $(tableID + ' th').each(function (index) {
        if(action === 'update')
            tdVal = $('#' + rowID + ' td').eq(index).text();
        var attribute = $(this).text().replace(/ /g, '');
        var labelText = $(this).text() + ':';

        if(labelText.includes("?")){
            attribute = attribute.replace('?', '');
            labelText = labelText.replace('?', '');
        }
        if (labelText == "Start Time"){
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="text" id="' + attribute + '" name="' + attribute + '" value="' + tdVal + '" autocomplete="off"/>';
        } else if (labelText == "End Time") {
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="text" id="' + attribute + '" name="' + attribute + '" value="' + tdVal +
                '" autocomplete="off"/>';
        } else if (labelText.includes("Type")) {
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="text" id="' + attribute + '" name="' + attribute + '" value="' + tdVal +
                '" autocomplete="off" required/>';
        } else if (labelText == "Historic Filter:") {
            input += '<label for="' + attribute + '">' + labelText + '</label><br><div class="hisFilter" id="hisFilter"></div>';
        } else if (labelText.includes("Date")) {
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="date" id="' + attribute + '" name="' + attribute + '" value="' + tdVal +
                '" autocomplete="off"/>';
        } else {
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="text" id="' + attribute + '" name="' + attribute + '" value="' + tdVal +
                '" autocomplete="off"/>';
        }
    });

    if(action === 'update')
    {
        // Generate inner HTML for form
        $('#updateModalBody').html(input);
        if (tableID == "#grave") {
            $(".historicSelect").clone().addClass("currentFilter").appendTo(".hisFilter");
            $(".historicSelect.currentFilter").removeClass("invisible");
        }

        // Show modal
        $(document).ready(function () {
            if (tableID == "#grave"){
                if (idHistoricFilter == null) {
                    $(".historicSelect.currentFilter option[value=0]").attr("selected", true);
                }
                $(".historicSelect.currentFilter option[value=" + idHistoricFilter + "]").attr("selected", true);
            }

            $('#updateModal').modal('show');
        });
    }
    else if(action === 'create')
    {
        $('#createModalBody').html(input);
        $('#createModal').modal('show');
    }
}

function updateGrave(rowID, idGrave, idTrackableObject, idHistoricFilter, idTypeFilter) {
    generateForm('#grave', rowID, idHistoricFilter);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idTrackableObject': idTrackableObject,
            'idGrave': idGrave,
            'idHistoricFilter':$(".historicSelect.currentFilter option:selected").val(),
            'idTypeFilter': idTypeFilter,
            'FirstName': $('#FirstName').val(),
            'MiddleName':$('#MiddleName').val(),
            'LastName':$('#LastName').val(),
            'BirthDate': $('#BirthDate').val(),
            'DeathDate': $('#DeathDate').val(),
            'Description': $('#Description').val(),
            'Longitude': $('#Longitude').val(),
            'Latitude': $('#Latitude').val(),
            'ImageDescription': $('#ImageDescription').val(),
            'ImageLocation': $('#ImageLocation').val(),
            'HistoricFilter': $('#HistoricFilter').val()
        };

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { updateGraveEntry: formData}
        }).done(function( msg ) {
            $('#updateModal').modal('hide');
            $('#updateModalBody').empty();
        });
    });
}

function updateNH(rowID, idNaturalHistory, idTrackableObject, idTypeFilter) {
    generateForm('#naturalHistory', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idTrackableObject': parseInt(idTrackableObject),
            'idNaturalHistory': parseInt(idNaturalHistory),
            'idTypeFilter': parseInt(idTypeFilter),
            'CommonName': $('#CommonName').val(),
            'ScientificName': $('#ScientificName').val(),
            'Description': $('#Description').val(),
            'Longitude': parseFloat($('#Longitude').val()),
            'Latitude': parseFloat($('#Latitude').val()),
            'ImageDescription': $('#ImageDescription').val(),
            'ImageLocation': $('#ImageLocation').val(),
            'Type': $('#Type').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { updateNaturalHistoryEntry: formData}
        }).done(function() {
            $('#updateModal').modal('hide');
            $('#updateModalBody').empty();
        });
    });
}

function updateMisc(rowID, idMiscObject, idTrackableObject, idTypeFilter) {
    generateForm('#misc', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idTrackableObject': idTrackableObject,
            'idMiscObject': idMiscObject,
            'idTypeFilter':idTypeFilter,
            'Name': $('#Name').val(),
            'Description': $('#Description').val(),
            'IsaHazard': $('#IsaHazard').val(),
            'Longitude': $('#Longitude').val(),
            'Latitude': $('#Latitude').val(),
            'ImageDescription': $('#ImageDescription').val(),
            'ImageLocation': $('#ImageLocation').val(),
            'Type': $('#Type').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { updateMiscObjectEntry: formData}
        }).done(function() {
            $('#updateModal').modal('hide');
            $('#updateModalBody').empty();
        });
    });
}

function updateType(rowID, idTypeFilter) {
    generateForm('#type', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idTypeFilter': idTypeFilter,
            'Name': $('#Name').val(),
            'PinDesign': $('#PinDesign').val(),
            'ButtonColor': $('#ButtonColor').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { updateTypeFilterEntry: formData}
        }).done(function() {
            $('#updateModal').modal('hide');
            $('#updateModalBody').empty();
        });
    });
}

function updateHistoricFilter(rowID, idHistoricFilter) {
    generateForm('#historic', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idHistoricFilter': idHistoricFilter,
            'Name': $('#Name').val(),
            'StartDate': $('#StartDate').val(),
            'EndDate': $('#EndDate').val(),
            'Description': $('#Description').val(),
            'ButtonColor': $('#ButtonColor').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { updateHistoricFilterEntry: formData}
        }).done(function() {
            $('#updateModal').modal('hide');
            $('#updateModalBody').empty();
        });
    });
}

function updateFAQ(rowID, idFAQ) {
    generateForm('#faq', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idFAQ': idFAQ,
            'Question': $('#Question').val(),
            'Answer': $('#Answer').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { updateFAQEntry: formData}
        }).done(function() {
            $('#updateModal').modal('hide');
            $('#updateModalBody').empty();
        });
    });
}

function updateLocation(rowID, idWiderAreaMap) {
    generateForm('#widerLocation', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idWiderAreaMap': idWiderAreaMap,
            'URL': $('#URL').val(),
            'Name': $('#Name').val(),
            'Description': $('#Description').val(),
            'Longitude': $('#Longitude').val(),
            'Latitude': $('#Latitude').val(),
            'Address': $('#Address').val(),
            'City': $('#City').val(),
            'State': $('#State').val(),
            'ZipCode': $('#ZipCode').val()
        };

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { updateWiderAreaMapEntry: formData}
        }).done(function() {
            $('#updateModal').modal('hide');
            $('#updateModalBody').empty();
        });
    });
}

function updateContact(rowID, idContact) {
    generateForm('#contact', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idContact': idContact,
            'Name': $('#Name').val(),
            'Email': $('#Email').val(),
            'Description': $('#Description').val(),
            'Phone': $('#Phone').val(),
            'Title': $('#Title').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { updateContactEntry: formData}
        }).done(function() {
            $('#updateModal').modal('hide');
            $('#updateModalBody').empty();
        });
    });
}

function updateEvent(rowID, idEvent, idWiderAreaMap) {
    generateForm('#event', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idEvent': idEvent,
            'Name': $('#Name').val(),
            'Location': $('#Location').val(),
            'Description': $('#Description').val(),
            'StartTime': $('#StartTime').val(),
            'EndTime': $('#EndTime').val(),
            'idWiderAreaMap': idWiderAreaMap};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { updateEventEntry: formData}
        }).done(function() {
            $('#updateModal').modal('hide');
            $('#updateModalBody').empty();
        });
    });
}

function createEvent() {
    generateForm('#event','','','create');
}