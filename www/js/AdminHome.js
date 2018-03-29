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

function generateUpdateModal(tableID, rowID, idHistoricFilter) {
    // Grab current table header value and corresponding table data value
    var input = '';
    var isHazard = "";
    $(tableID + ' th').each(function (index) {
        var tdVal = $('#' + rowID + ' td').eq(index).text();
        var attribute = $(this).text().replace(/ /g, '');
        var labelText = $(this).text() + ':';


        if(labelText.includes("?")){
            attribute = attribute.replace('?', '');
            labelText = labelText.replace('?', '');
        }
        if (labelText == "Start Time:"){
            var dateTimeArray = tdVal.split(" ");
            var time = dateTimeArray[1];
            var date = dateTimeArray[0];
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="date" id="startDate" name="startDate" value="' + date + '" autocomplete="off"/>' +
                '<input type="time" id="startTime" name="startTime" value="' + time + '" autocomplete="off"/>';

        } else if (labelText.includes("Longitude:") || labelText.includes("Latitude:")) {
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="number" step="0.000001" id="' + attribute + '" name="' + attribute + '" value="' + tdVal + '" autocomplete="off"/>';

        } else if (labelText.includes("Hazard:")) {
            input += '<label for="' + attribute + '">' + labelText + '</label><div class="radio"><label>Yes<input type="radio" name="isHazard" value="Yes"/></label></div>' +
                '<div class="radio"><label>No<input type="radio" name="isHazard" value="No"/></label></div>';
            isHazard = tdVal;
            
        } else if (labelText == "End Time:") {
            var dateTimeArray = tdVal.split(" ");
            var time = dateTimeArray[1];
            var date = dateTimeArray[0];
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="date" id="endDate" name="endDate" value="' + date + '" autocomplete="off"/>' +
                '<input type="time" id="endTime" name="endTime" value="' + time + '" autocomplete="off"/>';

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
        } if (tableID == "#misc") {
            if (isHazard == "No") {
                $('input[type="radio"][name="isHazard"]').filter('[value="No"]').prop('checked', true);
            } else {
                $('input[type="radio"][name="isHazard"]').filter('[value="Yes"]').prop('checked', true);
            }

        }

        $('#updateModal').modal('show');
    });
}

function generateCreateModal(tableID) {
    var input = '';
    $(tableID + ' th').each(function (index) {
        var attribute = $(this).text().replace(/ /g, '');
        var labelText = $(this).text() + ':';

        if(labelText.includes("?")){
            attribute = attribute.replace('?', '');
            labelText = labelText.replace('?', '');
        }
        if (labelText == "Start Time:"){
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="date" id="startDate" name="startDate" autocomplete="off"/>' +
                '<input type="time" id="startTime" name="startTime" autocomplete="off"/>';
        } else if (labelText == "End Time") {
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="date" id="endDate" name="endDate" autocomplete="off"/>' +
                '<input type="time" id="endTime" name="endTime" autocomplete="off"/>';
        } else if (labelText.includes("Type")) {
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="text" id="' + attribute + '" name="' + attribute + '"/>';
        } else if (labelText == "Historic Filter:") {
            input += '<label for="' + attribute + '">' + labelText + '</label><br><div class="hisFilter" id="hisFilter"></div>';
        } else if (labelText.includes("Hazard:")) {
            input += '<label for="' + attribute + '">' + labelText + '</label><div class="radio"><label>Yes<input type="radio" name="isHazard" value="Yes"/></label></div>' +
                '<div class="radio"><label>No<input type="radio" name="isHazard" value="No"/></label></div>';

        } else if (labelText.includes("Date")) {
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="date" id="' + attribute + '" name="' + attribute + '"/>';
        } else {
            input += '<label for="' + attribute + '">' + labelText + '</label>' +
                '<input type="text" id="' + attribute + '" name="' + attribute + '"/>';
        }
    });

    // Generate inner HTML for form
    $('#createModalBody').html(input);
    if (tableID == "#grave") {
        $(".historicSelect").clone().addClass("currentFilter").appendTo(".hisFilter");
        $(".historicSelect.currentFilter").removeClass("invisible");
    }

    // Show modal
    $(document).ready(function () {
        $(".historicSelect.currentFilter option[value=0]").attr("selected", true);
        $('#createModal').modal('show');
    });
}

function updateGrave(rowID, idGrave, idTrackableObject, idHistoricFilter, idTypeFilter) {
    generateUpdateModal('#grave', rowID, idHistoricFilter);

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
    generateUpdateModal('#naturalHistory', rowID);

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
    generateUpdateModal('#misc', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idTrackableObject': idTrackableObject,
            'idMiscObject': idMiscObject,
            'idTypeFilter':idTypeFilter,
            'Name': $('#Name').val(),
            'Description': $('#Description').val(),
            'IsaHazard': $('input[type="radio"][name="isHazard"]:checked').val(),
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
    generateUpdateModal('#type', rowID);

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
    generateUpdateModal('#historic', rowID);

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
    generateUpdateModal('#faq', rowID);

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
    generateUpdateModal('#widerLocation', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idWiderAreaMap': idWiderAreaMap,
            'Site': $('#Site').val(),
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
    generateUpdateModal('#contact', rowID);

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
    generateUpdateModal('#event', rowID);

    // Make AJAX POST request with JSON object to update entry in database
    $('#saveChanges').click(function () {
        var formData = {'idEvent': idEvent,
            'Name': $('#Name').val(),
            'Location': $('#Location').val(),
            'Description': $('#Description').val(),
            'StartTime': $('#startDate').val() + " " + $('#startTime').val(),
            'EndTime': $('#endDate').val() + " " + $('#endTime').val(),
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

function cancelChanges() {
    $('#updateModal').modal('hide');
    $('#updateModalBody').empty();
}

function cancelCreate() {
    $('#createModal').modal('hide');
    $('#createModalBody').empty();
}

function createGrave(){
    $('#createModalTitle').text('Create Grave');
    generateCreateModal('#grave');

    $('#createObject').click(function () {
        var formData = {'FirstName': $('#FirstName').val(),
            'MiddleName':$('#MiddleName').val(),
            'LastName':$('#LastName').val(),
            'BirthDate': $('#BirthDate').val(),
            'DeathDate': $('#DeathDate').val(),
            'Description': $('#Description').val(),
            'Longitude': $('#Longitude').val(),
            'Latitude': $('#Latitude').val(),
            'ImageDescription': $('#ImageDescription').val(),
            'ImageLocation': $('#ImageLocation').val(),
            'HistoricFilter': $('#HistoricFilter').val(),
            'idTypeFilter': 1,
            'idHistoricFilter': $('#historicSelect > option :selected').val()
        };

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { createGraveEntry: formData}
        }).done(function() {
            $('#createModal').modal('hide');
            $('#createModalBody').empty();
        });
    });
}

function createNH() {
    $('#createModalTitle').text('Create Natural History');
    generateCreateModal('#naturalHistory');

    $('#createObject').click(function () {
        var formData = {'CommonName': $('#CommonName').val(),
            'ScientificName': $('#ScientificName').val(),
            'Description': $('#Description').val(),
            'Longitude': parseFloat($('#Longitude').val()),
            'Latitude': parseFloat($('#Latitude').val()),
            'ImageDescription': $('#ImageDescription').val(),
            'ImageLocation': $('#ImageLocation').val(),
            'idTypeFilter': 2};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { createNaturalHistoryEntry: formData}
        }).done(function() {
            $('#createModal').modal('hide');
            $('#createModalBody').empty();
        });
    });
}

function createMisc() {
    $('#createModalTitle').text('Create Miscellaneous');
    generateCreateModal('#misc');

    $('#createObject').click(function () {
        var formData = {'Name': $('#Name').val(),
            'Description': $('#Description').val(),
            'IsaHazard': $('input[type="radio"][name="isHazard"]:checked').val(),
            'Longitude': $('#Longitude').val(),
            'Latitude': $('#Latitude').val(),
            'ImageDescription': $('#ImageDescription').val(),
            'ImageLocation': $('#ImageLocation').val(),
            'Type': $('#Type').val(),
            'idTypeFilter': null};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { createMiscObjectEntry: formData}
        }).done(function() {
            $('#createModal').modal('hide');
            $('#createModalBody').empty();
        });
    });
}

function createTypeFilter() {
    $('#createModalTitle').text('Create Type Filter');
    generateCreateModal('#type');

    $('#createObject').click(function () {
        var formData = {'Name': $('#Name').val(),
            'PinDesign': $('#PinDesign').val(),
            'ButtonColor': $('#ButtonColor').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { createTypeFilterEntry: formData}
        }).done(function() {
            $('#createModal').modal('hide');
            $('#createModalBody').empty();
        });
    });
}

function createHistoricFilter() {
    $('#createModalTitle').text('Create Historic Filter');
    generateCreateModal('#historic');

    $('#createObject').click(function () {
        var formData = {'Name': $('#Name').val(),
            'StartDate': $('#StartDate').val(),
            'EndDate': $('#EndDate').val(),
            'Description': $('#Description').val(),
            'ButtonColor': $('#ButtonColor').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { createHistoricFilterEntry: formData}
        }).done(function() {
            $('#createModal').modal('hide');
            $('#createModalBody').empty();
        });
    });
}

function createFAQ() {
    $('#createModalTitle').text('Create FAQ');
    generateCreateModal('#faq');

    $('#createObject').click(function () {
        var formData = {'Question': $('#Question').val(),
            'Answer': $('#Answer').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { createFAQEntry: formData}
        }).done(function() {
            $('#createModal').modal('hide');
            $('#createModalBody').empty();
        });
    });
}

function createWiderLocation() {
    $('#createModalTitle').text('Create Wider Area Location');
    generateCreateModal('#widerLocation');

    $('#createObject').click(function () {
        var formData = {'Site': $('#Site').val(),
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
            data: { createWiderAreaMapEntry: formData}
        }).done(function() {
            $('#createModal').modal('hide');
            $('#createModalBody').empty();
        });
    });
}

function createContact() {
    $('#createModalTitle').text('Create Contact');
    generateCreateModal('#contact');

    $('#createObject').click(function () {
        var formData = {'Name': $('#Name').val(),
            'Email': $('#Email').val(),
            'Description': $('#Description').val(),
            'Phone': $('#Phone').val(),
            'Title': $('#Title').val()};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { createContactEntry: formData}
        }).done(function() {
            $('#createModal').modal('hide');
            $('#createModalBody').empty();
        });
    });
}

function createEvent() {
    $('#createModalTitle').text('Create Event');
    generateCreateModal('#event');

    $('#createObject').click(function () {
        var formData = {'Name': $('#Name').val(),
            'Location': $('#Location').val(),
            'Description': $('#Description').val(),
            'StartTime': $('#startDate').val() + " " + $('#startTime').val(),
            'EndTime': $('#endDate').val() + " " + $('#endTime').val(),
            'idWiderAreaMap': null};

        $.ajax({
            method: "POST",
            url: "../ajaxCalls.php",
            data: { createEventEntry: formData}
        }).done(function() {
            $('#createModal').modal('hide');
            $('#createModalBody').empty();
        });
    });
}