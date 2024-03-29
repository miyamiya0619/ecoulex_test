$(document).ready(function () {
    // 削除ボタンのクリックイベントの設定
    $('.delete-button').on('click', function () {
        var confirmDelete = confirm('削除しますか？');
        if (confirmDelete) {
            alert('削除されました。');
        }
    });

    // ファイルアップロードのダミーボタンのクリックイベント
    $('#upload-btn').on('click', function () {
        $('#file-upload').click();
    });

    // フォーム検証関数
    window.validateForm = function () {
        var isValid = true;
        var requiredFields = $("input[required], textarea[required], select[required]");

        // テキストフィールド、テキストエリア、プルダウンの検証
        requiredFields.each(function () {
            if ($(this).is('select')) {
                if ($(this).val() === null || $(this).val() === '') {
                    isValid = false;
                }
            } else if (!$(this).val().trim()) {
                isValid = false;
            }
        });

        // チェックボックスの検証
        var checkBoxGroups = {};
        $('input[type="checkbox"][required]').each(function () {
            var name = $(this).attr('name');
            checkBoxGroups[name] = checkBoxGroups[name] || [];
            checkBoxGroups[name].push(this);
        });

        $.each(checkBoxGroups, function (name, checkBoxes) {
            if (!checkBoxes.some(box => box.checked)) {
                isValid = false;
            }
        });

        if (!isValid) {
            alert("必須項目をすべて入力してください。");
            return false; // フォームの送信を防ぐ
        } else {
            // ここにフォーム送信のコードを追加
            return true;
        }
    };

    // 必須フィールドに関する関数はそのまま保持し、プルダウンにも適用します
    addRequiredTextToCheckboxGroup();
    addRequiredTextToOtherFields();
    addRequiredTextToSelectFields(); // プルダウン用の関数を追加
    addRequiredFieldStyles();
});

function addRequiredTextToCheckboxGroup() {
    // チェックボックスグループのコンテナに「必須」を追加
    if ($(".checkbox input[type='checkbox'][required]").length) {
        $(".checkbox").append('<div class="required-asterisk_long">* 少なくとも一つ選択必須</div>');
    }
}

function addRequiredTextToOtherFields() {
    // テキストフィールドとテキストエリアに「必須」を追加
    $("input[type='text'][required], textarea[required]").each(function () {
        var field = $(this);
        if (!field.next('.required-asterisk').length) {
            field.after('<span class="required-asterisk">* 必須</span>');
        }
    });
}

function addRequiredTextToSelectFields() {
    // プルダウンに「必須」を追加
    $("select[required]").each(function () {
        var select = $(this);
        if (!select.next('.required-asterisk').length) {
            select.after('<span class="required-asterisk">* 必須</span>');
        }
    });
}

function addRequiredFieldStyles() {
    // 必須フィールドのスタイルを追加
    var style = $('<style>');
    style.html(`
        .required-asterisk {
            color: red;
            font-size: 10px;
            margin-left: 4px;
            width: 40px;
        }
        .required-asterisk_long {
            color: red;
            font-size: 10px;
            margin-left: 4px;
            width: 120px;
        }
    `);
    $('head').append(style);
}
