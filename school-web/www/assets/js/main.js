// potřeba jquery
const delay = ms => new Promise(res => setTimeout(res, ms));

const autoDismissBySelector = async (selector, waitMs = 10000, speedMs = 500) => {
    await delay(waitMs);
    dismissBySelector(selector, waitMs, speedMs);
};

const dismissBySelector = (selector, waitMs, speedMs) => {
    const element = $(selector);

    if (element.length > 0) {
        element.fadeTo(speedMs, 0).slideUp(speedMs, function () {
            $(this).remove();
        });
    }
}

autoDismissBySelector('.alert').then();

$('[data-dismissable]').on('mousedown', function (e) {
    e.preventDefault();
    dismissBySelector($(this).closest('.alert'));
});

$(':input[required]:visible:not([name*=files])').each(function () {
    const name = $(this).attr('name');

    $(`label[for=${name}]`).append('<span class="text-danger">*</span>')
})
