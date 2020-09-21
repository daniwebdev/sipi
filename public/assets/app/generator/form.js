$('.progress-status').hide();
$('select').selectpicker();

let html = `
      <tr>
        <td scope="row">
          <input type="text" class="form-control" name="columns[][name]">
        </td>
        <td>
          <select data-size=5 data-live-search=true name="columns[][type]" id="">
            <option value="">None</option>
            <option value="foreignId">foreignId</option>
            <option value="unsignedBigInteger">unsignedBigInteger</option>
            <option value="bigIncrements">bigIncrements</option>
            <option value="bigInteger">bigInteger</option>
            <option value="binary">binary</option>
            <option value="boolean">boolean</option>
            <option value="char">char</option>
            <option value="date">date</option>
            <option value="dateTime">dateTime</option>
            <option value="dateTimeTz">dateTimeTz</option>
            <option value="decimal">decimal</option>
            <option value="double">double</option>
            <option value="enum">enum</option>
            <option value="float">float</option>
            <option value="geometry">geometry</option>
            <option value="geometryCollection">geometryCollection</option>
            <option value="increments">increments</option>
            <option value="integer">integer</option>
            <option value="ipAddress">ipAddress</option>
            <option value="json">json</option>
            <option value="jsonb">jsonb</option>
            <option value="lineString">lineString</option>
            <option value="longText">longText</option>
            <option value="macAddress">macAddress</option>
            <option value="mediumIncrements">mediumIncrements</option>
            <option value="mediumInteger">mediumInteger</option>
            <option value="mediumText">mediumText</option>
            <option value="morphs">morphs</option>
            <option value="uuidMorphs">uuidMorphs</option>
            <option value="multiLineString">multiLineString</option>
            <option value="multiPoint">multiPoint</option>
            <option value="multiPolygon">multiPolygon</option>
            <option value="nullableMorphs">nullableMorphs</option>
            <option value="nullableUuidMorphs">nullableUuidMorphs</option>
            <option value="nullableTimestamps">nullableTimestamps</option>
            <option value="point">point</option>
            <option value="polygon">polygon</option>
            <option value="rememberToken">rememberToken</option>
            <option value="set">set</option>
            <option value="smallIncrements">smallIncrements</option>
            <option value="smallInteger">smallInteger</option>
            <option value="softDeletes">softDeletes</option>
            <option value="softDeletesTz">softDeletesTz</option>
            <option value="string">string</option>
            <option value="text">text</option>
            <option value="time">time</option>
            <option value="timeTz">timeTz</option>
            <option value="timestamp">timestamp</option>
            <option value="timestampTz">timestampTz</option>
            <option value="timestamps">timestamps</option>
            <option value="timestampsTz">timestampsTz</option>
            <option value="tinyIncrements">tinyIncrements</option>
            <option value="tinyInteger">tinyInteger</option>
            <option value="unsignedBigInteger">unsignedBigInteger</option>
            <option value="unsignedDecimal">unsignedDecimal</option>
            <option value="unsignedInteger">unsignedInteger</option>
            <option value="unsignedMediumInteger">unsignedMediumInteger</option>
            <option value="unsignedSmallInteger">unsignedSmallInteger</option>
            <option value="unsignedTinyInteger">unsignedTinyInteger</option>
            <option value="uuid">uuid</option>
            <option value="year">year</option>
          </select>
        </td>
        <td>
          <select name="columns[][form_as]" id="">
            <option value="">None</option>
            <option value="upload">Upload</option>
          </select>
        </td>
        <td>
          <input placeholder="ClassName" type="text" class="form-control" name="columns[][relation]">
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm del-row"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
  `;

$('#add-row').click(function() {
    let table = $('#table-column tbody');

    table.append(html);
    $('select').selectpicker();
});

$(document).on('click', '.del-row', function() {
    let length = $('#table-column tbody').find('tr').length;

    if (length > 1) {
        let row = $(this).closest('tr');
        row.remove();
    }
})

function camelize(str) {
    return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
        return index === 0 ? word.toUpperCase() : word.toUpperCase();
    }).replace(/\s+/g, '');
}

$('#name').keyup(function() {
    let name = $(this).val();
    let controller = camelize(name) + "Controller";
    let model = camelize(name);
    let route = name.toLowerCase().replace(' ', '_');

    $('#controller_name').val(controller);
    $('#model_name').val(model);
    $('#view_directory').val(route);
    $('#route_prefix').val('/' + route);
});

$('#form-two-column').change(function() {

    let container = $('#form-builder-container');
    container.toggleClass('row');
    container.find('.form-group').toggleClass('col-6')
});

var column_deffinition = []

$('#save-form').click(function() {
    let FormProperties = $('#input-properties');
    let index = $('.input-item').length;

    let form_deff = {}
    FormProperties.serializeArray().forEach(x => {
        form_deff[x.name] = x.value;
    });

    column_deffinition.push({
        index: index,
        deff: form_deff
    });

    console.log(column_deffinition);

    let template = $(`.form-builder-template[data-type*='${form_deff.input_form_type}']`).html();
    let twoCol = $('#form-two-column').prop('checked');

    let build_form = template.replace(/{label}/g, form_deff.input_label)
        .replace(/{index}/g, index)
        .replace(/{name}/g, form_deff.input_name)
        .replace(/{placeholder}/g, form_deff.input_label);

    let temp = $(build_form);

    if (twoCol) {
        temp.addClass('col-6');
    }

    temp.attr('data', JSON.stringify(form_deff));

    $('.not-found').hide();

    temp.appendTo($('#form-builder-container')).slideDown('fast');

    FormProperties[0].reset()
    $('[selectpicker]').selectpicker('refresh');

    $('#modal-input-properties').modal('hide');
});

//Delete Input
$(document).on('click', '.delete-input', function() {
    let _el = $(this).closest('.input-item');
    _el.slideUp(500, () => {
        _el.remove();

        if ($('.input-item').length == 0) {
            $('.not-found').fadeIn(500);
        }
    });

});

//Build Now 
function BuildNow(colDeff) {
    let _columns = colDeff;
    let _progress_value = 0;

    // Controller Generated...
    // Model Generated...
    // Migration Generated...
    // Route Added...
    // RESTApi Generated...
    let writeLn = (text) => {
        $('#build-log').append(`[${moment().format('YY-MM-DD HH:mm:ss')}] ` + text + "\n");
        $log = document.getElementById('build-log');
        $log.scrollTop = $log.scrollHeight
    }

    //set Progressbar loading
    let set_progress = (add_value) => {

        _progress_value += add_value;
        $('#build-progress-bar').css('width', `${_progress_value}%`).text(`${_progress_value}%`);
        // for (let i = 1; i <= add_value; i++) {
        //     times = [1500, 1000];
        //     var time = times[Math.floor(Math.random() * times.length)];

        //     setTimeout(function timer() {
        //     }, time);
        // }

    }

    this.init = () => {
        let form_html = $('<div></div>').html($('#form-builder-container').html());
        form_html.find('.not-found').remove();
        form_html.find('.editor-addon').remove();

    }

    this.controller = () => {
        let self = this;
        writeLn("Generate controller...");
        set_progress(10);
        axios.post(`${BASE_BUILD}/controller`, {
            name: $('#name').val(),
            columns: colDeff,
            controller: $('#controller_name').val(),
            view_directory: $('#view_directory').val(),
        }).then(res => {
            set_progress(4);
            writeLn(res.data.message);

            setTimeout(() => {
                self.model();
            }, 1000);
        });
    }

    this.model = () => {
        let self = this;
        set_progress(30);
        writeLn("Generate model with migration...");
        axios.post(`${BASE_BUILD}/model`, {
            name: $('#name').val(),
            columns: colDeff,
            controller: $('#model_name').val(),
            view_directory: $('#view_directory').val(),
        }).then(res => {
            set_progress(4);
            writeLn(res.data.message);
            setTimeout(() => {
                self.route();
            }, 1000);
        });

    }

    this.route = () => {
        set_progress(38);
        writeLn("Generate routing...");
        writeLn("");
        writeLn("Job successful.");
        writeLn("wait modal will close.");
        writeLn("===================================");
        _success();
        setTimeout(() => {
            _closeModal();
        }, 3000);

    }

    //View 1
    this.view = () => {
        let self = this;
        set_progress(10);
        writeLn("Generate view resources...");
        axios.post(`${BASE_BUILD}/view`, {
            name: $('#name').val(),
            columns: colDeff,
            view_directory: $('#view_directory').val(),
        }).then(res => {
            set_progress(4);
            writeLn(res.data.message);
            setTimeout(() => {
                self.controller();
            }, 1000);
        });
    }

} // End Function
$('#build-now-btn').click(function() {


    showAlert('Are You Sure ?', "Build crud right now.", 'question')
        .then(x => {

            if (x.value) {
                _onProgress();
                let build = new BuildNow()
                build.view();

                $('#process-dialog').modal('show');


            } else {

            }

        });
});

function _success() {
    $('.progress-status').hide();
    $('#progress-success').show()
}

function _onProgress() {
    $('.progress-status').hide();
    $('#progress-on').show()
}

function _error() {
    $('.progress-status').hide();
    $('#progress-error').show()
}

function _closeModal() {
    $('#process-dialog').modal('hide')
}

/* Input Properties */
//Input Label KeyUp
$('#input_label').keyup(function() {
    let val = $(this).val().replace(' ', '_').toLowerCase()
    $('#input_name').val(val);
});