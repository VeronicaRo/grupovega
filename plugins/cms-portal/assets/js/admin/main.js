;(function ($) {
    "use strict";

    $(document).ready(function () {
        checkBulkActionPlugins();
    });

    $(document).on('click', '.btn-verify-purchase-code', function () {
        var _this = $(this);
        var formData = new FormData(_this.parents('form')[0]);

        $.ajax({
            url: cms_portal.ajax_url,
            type: "POST",
            beforeSend: function () {
                _this.addClass('running');
            },
            data: formData,
            contentType: false,
            processData: false,
        }).done(function (res) {
            var alert = new CMSAlert();
            if (res.stt) {
                window.location.reload();
            } else {
                alert.alert(res.msg, 'danger');
            }
        }).fail(function (res) {

        }).always(function () {
            _this.removeClass('running');
        });

        return false;
    });

    $(document).on('click', '#open-login-form', function () {
        var form = $('#login-form');
        form.fadeToggle();

        return false;
    });

    $(document).on('click', '.btn-login', function () {
        var _this = $(this);
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: cms_portal.ajax_url,
            type: "POST",
            beforeSend: function () {
                _this.addClass('running');
            },
            data: {
                action: 'cpt_login_to_server',
                username: username,
                password: password,
            },
        }).done(function (res) {
            var alert = new CMSAlert();
            if (res.stt) {
                window.location.reload();
            } else {
                alert.alert(res.msg, 'danger');
            }
        }).fail(function (res) {

        }).always(function () {
            _this.removeClass('running');
        });

        return false;
    });

    $(document).on('click', '.user-actions-item a[data-action]', function () {
        var _this = $(this);
        var action = _this.data('action');

        switch (action) {
            case 'log-out':
                $.ajax({
                    url: cms_portal.ajax_url,
                    type: "POST",
                    beforeSend: function () {

                    },
                    data: {
                        'action': 'cpt_log_out'
                    },
                }).done(function (res) {
                    var alert = new CMSAlert();
                    if (res.stt) {
                        window.location.reload();
                    } else {
                        alert.alert(res.msg, 'danger');
                    }
                }).fail(function (res) {

                }).always(function () {

                });
                break;
        }

        return false;
    });

    $(document).on('click', '.install-plugin', function () {
        var _this = $(this);
        var type = _this.data('type');
        var _wpnonce = _this.data('nonce');
        var plugin_slug = _this.data('plugin-slug');

        if (_this.hasClass('install-plugin')) {
            $.ajax({
                url: cms_portal.ajax_url,
                type: "POST",
                beforeSend: function () {
                    _this.addClass('loading');
                    _this.text('Installing');
                },
                data: {
                    action: 'cpt_install_plugin',
                    type: type,
                    _wpnonce: _wpnonce,
                    plugin_slug: plugin_slug,
                },
            }).done(function (res) {
                var alert = new CMSAlert();
                if (res.stt) {
                    $('#' + plugin_slug).replaceWith(res.data);
                    checkBulkActionPlugins();
                    alert.alert(res.msg, 'success');
                } else {
                    _this.text('Install');
                    alert.alert(res.msg, 'danger');
                }
            }).fail(function (res) {
                _this.text('Install');
            }).always(function () {
                _this.removeClass('loading');
            });
        }

        return false;
    });

    $(document).on('click', '.activate-plugin', function () {
        var _this = $(this);
        var _wpnonce = _this.data('nonce');
        var plugin_slug = _this.data('plugin-slug');

        if (_this.hasClass('activate-plugin')) {
            $.ajax({
                url: cms_portal.ajax_url,
                type: "POST",
                beforeSend: function () {
                    _this.addClass('loading');
                    _this.text('Activating');
                },
                data: {
                    action: 'cpt_activate_plugin',
                    _wpnonce: _wpnonce,
                    plugin_slug: plugin_slug,
                },
            }).done(function (res) {
                var alert = new CMSAlert();
                if (res.stt) {
                    $('#' + plugin_slug).replaceWith(res.data);
                    checkBulkActionPlugins();
                    alert.alert(res.msg, 'success');
                } else {
                    _this.text('Activate');
                    alert.alert(res.msg, 'danger');
                }
            }).fail(function (res) {
                _this.text('Activate');
            }).always(function () {
                _this.removeClass('loading');
            });
        }

        return false;
    });

    $(document).on('click', '.update-plugin', function () {
        var _this = $(this);
        var type = _this.data('type');
        var _wpnonce = _this.data('nonce');
        var plugin_slug = _this.data('plugin-slug');

        $.ajax({
            url: cms_portal.ajax_url,
            type: "POST",
            beforeSend: function () {
                _this.addClass('loading');
                _this.text('Updating');
            },
            data: {
                action: 'cpt_update_plugin',
                type: type,
                _wpnonce: _wpnonce,
                plugin_slug: plugin_slug,
            },
        }).done(function (res) {
            var alert = new CMSAlert();
            if (res.stt || res.success) {
                alert.alert(res.msg, 'success');
                $('#' + plugin_slug).replaceWith(res.data);
            } else {
                _this.text('Update');
                alert.alert(res.msg, 'danger');
            }
        }).fail(function (res) {
            _this.text('Update');
        }).always(function () {
            _this.removeClass('loading');
        });

        return false;
    });

    $(document).on('click', '.update-theme', function () {
        if (!confirm("Are you sure you want to update theme?")) {
            return false;
        }

        var _this = $(this);
        var _wpnonce = _this.data('nonce');

        $.ajax({
            url: cms_portal.ajax_url,
            type: "POST",
            beforeSend: function () {
                _this.addClass('loading');
                _this.text('Updating');
            },
            data: {
                action: 'cpt_update_theme',
                _wpnonce: _wpnonce,
            },
        }).done(function (res) {
            var alert = new CMSAlert();
            if (res.stt) {
                alert.alert(res.msg, 'success');
                _this.remove();
            } else {
                _this.text('Update');
                alert.alert(res.msg, 'danger');
            }
        }).fail(function (res) {
            _this.text('Update');
        }).always(function () {
            _this.removeClass('loading');
        });

        return false;
    });

    $(document).on('click', '#btn-install-activate-plugins', function () {
        var _this = $(this);
        if (!_this.hasClass('loading')) {
            _this.addClass('loading');

            waitFor(function () {
                var count = $('.install-plugin').length + $('.activate-plugin').length;
                var error = $('.install-error').length + $('.activate-error').length;
                return count == 0 || error > 0;
            }, function () {
                var error = $('.install-error').length + $('.activate-error').length;
                var alert = new CMSAlert();
                if (error > 0) {
                    alert.alert('An error occurred while Installing and Activating the required plugins. Please reload page and try again!', 'danger');
                    _this.removeClass('loading');
                }
                else {
                    alert.alert('Installation and Activation Completed', 'success');
                    $.ajax({
                        url: cms_portal.ajax_url,
                        type: "POST",
                        beforeSend: function () {

                        },
                        data: {
                            action: 'cpt_can_import_demo',
                        },
                    }).done(function (res) {
                        if (res.stt) {
                            window.location.href = res.data;
                        } else {
                            window.location.reload();
                        }
                    }).fail(function (res) {

                    }).always(function () {
                        _this.removeClass('loading');
                    });
                }
            }, 'Wait for finish install & activate all plugins', 500);
            installAndActiveOneByOne();
        }

        return false;
    });

    function checkBulkActionPlugins() {
        var needInstall = $('.need-install').length;
        var needActivate = $('.need-activate').length;
        var installAndActivateAllEl = $('#install-activate-plugins');
        if (needInstall > 0 || needActivate > 0) {
            installAndActivateAllEl.show();
        } else {
            installAndActivateAllEl.hide();
        }
    }

    function installAndActiveOneByOne() {
        var installPluginEls = $('.install-plugin');
        if (installPluginEls.length > 0) {
            var _this = $(installPluginEls[0]);
            var type = _this.data('type');
            var _wpnonce = _this.data('nonce');
            var plugin_slug = _this.data('plugin-slug');

            $.ajax({
                url: cms_portal.ajax_url,
                type: "POST",
                beforeSend: function () {
                    _this.addClass('loading');
                    _this.text('Installing');
                },
                data: {
                    action: 'cpt_install_plugin',
                    type: type,
                    _wpnonce: _wpnonce,
                    plugin_slug: plugin_slug,
                },
            }).done(function (res) {
                var alert = new CMSAlert();
                if (res.stt) {
                    $('#' + plugin_slug).replaceWith(res.data);
                    checkBulkActionPlugins();
                    installAndActiveOneByOne();
                    alert.alert(res.msg, 'success');
                } else {
                    _this.text('Install');
                    alert.alert(res.msg, 'danger');
                    _this.addClass('install-error');
                }
            }).fail(function (res) {
                _this.text('Install');
                _this.addClass('install-error');
            }).always(function () {
                _this.removeClass('loading');
            });
        }
        else {
            var activatePluginEls = $('.activate-plugin');
            if (activatePluginEls.length > 0) {
                _this = $(activatePluginEls[0]);
                _wpnonce = _this.data('nonce');
                plugin_slug = _this.data('plugin-slug');

                $.ajax({
                    url: cms_portal.ajax_url,
                    type: "POST",
                    beforeSend: function () {
                        _this.addClass('loading');
                        _this.text('Activating');
                    },
                    data: {
                        action: 'cpt_activate_plugin',
                        _wpnonce: _wpnonce,
                        plugin_slug: plugin_slug,
                    },
                }).done(function (res) {
                    var alert = new CMSAlert();
                    if (res.stt) {
                        $('#' + plugin_slug).replaceWith(res.data);
                        checkBulkActionPlugins();
                        installAndActiveOneByOne();
                        alert.alert(res.msg, 'success');
                    } else {
                        _this.text('Activate');
                        alert.alert(res.msg, 'danger');
                        _this.addClass('activate-error');
                    }
                }).fail(function (res) {
                    _this.text('Activate');
                    _this.addClass('activate-error');
                }).always(function () {
                    _this.removeClass('loading');
                });
            }
        }
    }

    function isEmpty(val) {
        return typeof val === "undefined" || val === "" || val === null || (typeof val === "object" && $.isEmptyObject(val)) || ($.isArray(val) && val.lenght === 0);
    }

    function waitFor(condition, callback, message, time) {
        if (isEmpty(message)) {
            message = 'Timeout';
        }
        var cond = condition();
        if (cond) {
            callback();
        } else {
            setTimeout(function () {
                console.log(message);
                waitFor(condition, callback, message, time);
            }, time);
        }
    }
})(jQuery);