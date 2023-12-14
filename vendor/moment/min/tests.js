
;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('af');

    test('parse', function (assert) {
        var tests = 'Januarie Jan_Februarie Feb_Maart Mar_April Apr_Mei Mei_Junie Jun_Julie Jul_Augustus Aug_September Sep_Oktober Okt_November Nov_Desember Des'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(' ');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, MMMM Do YYYY, h:mm:ss a',      'Sondag, Februarie 14de 2010, 3:25:50 nm'],
                ['ddd, hA',                            'Son, 3NM'],
                ['M Mo MM MMMM MMM',                   '2 2de 02 Februarie Feb'],
                ['YYYY YY',                            '2010 10'],
                ['D Do DD',                            '14 14de 14'],
                ['d do dddd ddd dd',                   '0 0de Sondag Son So'],
                ['DDD DDDo DDDD',                      '45 45ste 045'],
                ['w wo ww',                            '6 6de 06'],
                ['h hh',                               '3 03'],
                ['H HH',                               '15 15'],
                ['m mm',                               '25 25'],
                ['s ss',                               '50 50'],
                ['a A',                                'nm NM'],
                ['[the] DDDo [day of the year]',       'the 45ste day of the year'],
                ['LT',                                 '15:25'],
                ['LTS',                                '15:25:50'],
                ['L',                                  '14/02/2010'],
                ['LL',                                 '14 Februarie 2010'],
                ['LLL',                                '14 Februarie 2010 15:25'],
                ['LLLL',                               'Sondag, 14 Februarie 2010 15:25'],
                ['l',                                  '14/2/2010'],
                ['ll',                                 '14 Feb 2010'],
                ['lll',                                '14 Feb 2010 15:25'],
                ['llll',                               'Son, 14 Feb 2010 15:25']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '1ste', '1ste');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '2de', '2de');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '3de', '3de');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '4de', '4de');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '5de', '5de');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '6de', '6de');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '7de', '7de');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '8ste', '8ste');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '9de', '9de');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '10de', '10de');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '11de', '11de');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '12de', '12de');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '13de', '13de');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '14de', '14de');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '15de', '15de');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '16de', '16de');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '17de', '17de');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '18de', '18de');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '19de', '19de');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '20ste', '20ste');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '21ste', '21ste');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '22ste', '22ste');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '23ste', '23ste');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '24ste', '24ste');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '25ste', '25ste');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '26ste', '26ste');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '27ste', '27ste');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '28ste', '28ste');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '29ste', '29ste');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '30ste', '30ste');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '31ste', '31ste');
    });

    test('format month', function (assert) {
        var expected = 'Januarie Jan_Februarie Feb_Maart Mar_April Apr_Mei Mei_Junie Jun_Julie Jul_Augustus Aug_September Sep_Oktober Okt_November Nov_Desember Des'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'Sondag Son So_Maandag Maa Ma_Dinsdag Din Di_Woensdag Woe Wo_Donderdag Don Do_Vrydag Vry Vr_Saterdag Sat Sa'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  '\'n paar sekondes', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  '\'n minuut',      '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  '\'n minuut',      '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '2 minute',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '44 minute',    '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  '\'n uur',       '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  '\'n uur',       '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '2 ure',       '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '5 ure',       '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '21 ure',      '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  '\'n dag',         '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  '\'n dag',         '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '2 dae',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   '\'n dag',         '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '5 dae',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '25 dae',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  '\'n maand',       '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  '\'n maand',       '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  '\'n maand',       '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '2 maande',      '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '2 maande',      '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '3 maande',      '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   '\'n maand',       '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '5 maande',      '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), '\'n jaar',        '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '2 jaar',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   '\'n jaar',        '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '5 jaar',       '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'oor \'n paar sekondes',  'prefix');
        assert.equal(moment(0).from(30000), '\'n paar sekondes gelede', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), '\'n paar sekondes gelede',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'oor \'n paar sekondes', 'in a few seconds');
        assert.equal(moment().add({d: 5}).fromNow(), 'oor 5 dae', 'in 5 days');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'Vandag om 12:00',     'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'Vandag om 12:25',     'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),       'Vandag om 13:00',     'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),       'Môre om 12:00',       'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'Vandag om 11:00',     'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'Gister om 12:00',     'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('dddd [om] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [om] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [om] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format('[Laas] dddd [om] LT'),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('[Laas] dddd [om] LT'),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('[Laas] dddd [om] LT'),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2012, 0,  1]).format('w ww wo'), '52 52 52ste', 'Jan  1 2012 should be week 52');
        assert.equal(moment([2012, 0,  2]).format('w ww wo'),   '1 01 1ste', 'Jan  2 2012 should be week 1');
        assert.equal(moment([2012, 0,  8]).format('w ww wo'),   '1 01 1ste', 'Jan  8 2012 should be week 1');
        assert.equal(moment([2012, 0,  9]).format('w ww wo'),    '2 02 2de', 'Jan  9 2012 should be week 2');
        assert.equal(moment([2012, 0, 15]).format('w ww wo'),    '2 02 2de', 'Jan 15 2012 should be week 2');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('ar-ma');

    test('parse', function (assert) {
        var tests = 'يناير:يناير_فبراير:فبراير_مارس:مارس_أبريل:أبريل_ماي:ماي_يونيو:يونيو_يوليوز:يوليوز_غشت:غشت_شتنبر:شتنبر_أكتوبر:أكتوبر_نونبر:نونبر_دجنبر:دجنبر'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(':');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, MMMM Do YYYY, h:mm:ss a',      'الأحد, فبراير 14 2010, 3:25:50 pm'],
                ['ddd, hA',                            'احد, 3PM'],
                ['M Mo MM MMMM MMM',                   '2 2 02 فبراير فبراير'],
                ['YYYY YY',                            '2010 10'],
                ['D Do DD',                            '14 14 14'],
                ['d do dddd ddd dd',                   '0 0 الأحد احد ح'],
                ['DDD DDDo DDDD',                      '45 45 045'],
                ['w wo ww',                            '8 8 08'],
                ['h hh',                               '3 03'],
                ['H HH',                               '15 15'],
                ['m mm',                               '25 25'],
                ['s ss',                               '50 50'],
                ['a A',                                'pm PM'],
                ['[the] DDDo [day of the year]',       'the 45 day of the year'],
                ['LT',                                 '15:25'],
                ['LTS',                                '15:25:50'],
                ['L',                                  '14/02/2010'],
                ['LL',                                 '14 فبراير 2010'],
                ['LLL',                                '14 فبراير 2010 15:25'],
                ['LLLL',                               'الأحد 14 فبراير 2010 15:25'],
                ['l',                                  '14/2/2010'],
                ['ll',                                 '14 فبراير 2010'],
                ['lll',                                '14 فبراير 2010 15:25'],
                ['llll',                               'احد 14 فبراير 2010 15:25']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '1', '1');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '2', '2');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '3', '3');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '4', '4');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '5', '5');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '6', '6');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '7', '7');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '8', '8');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '9', '9');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '10', '10');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '11', '11');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '12', '12');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '13', '13');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '14', '14');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '15', '15');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '16', '16');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '17', '17');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '18', '18');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '19', '19');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '20', '20');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '21', '21');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '22', '22');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '23', '23');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '24', '24');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '25', '25');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '26', '26');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '27', '27');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '28', '28');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '29', '29');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '30', '30');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '31', '31');
    });

    test('format month', function (assert) {
        var expected = 'يناير يناير_فبراير فبراير_مارس مارس_أبريل أبريل_ماي ماي_يونيو يونيو_يوليوز يوليوز_غشت غشت_شتنبر شتنبر_أكتوبر أكتوبر_نونبر نونبر_دجنبر دجنبر'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'الأحد احد ح_الإتنين اتنين ن_الثلاثاء ثلاثاء ث_الأربعاء اربعاء ر_الخميس خميس خ_الجمعة جمعة ج_السبت سبت س'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'ثوان', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'دقيقة',      '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'دقيقة',      '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '2 دقائق',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '44 دقائق',    '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'ساعة',       '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'ساعة',       '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '2 ساعات',       '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '5 ساعات',       '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '21 ساعات',      '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'يوم',         '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'يوم',         '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '2 أيام',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'يوم',         '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '5 أيام',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '25 أيام',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'شهر',       '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'شهر',       '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  'شهر',       '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '2 أشهر',      '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '2 أشهر',      '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '3 أشهر',      '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'شهر',       '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '5 أشهر',      '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'سنة',        '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '2 سنوات',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'سنة',        '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '5 سنوات',       '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'في ثوان',  'prefix');
        assert.equal(moment(0).from(30000), 'منذ ثوان', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'منذ ثوان',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'في ثوان', 'in a few seconds');
        assert.equal(moment().add({d: 5}).fromNow(), 'في 5 أيام', 'in 5 days');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'اليوم على الساعة 12:00',     'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'اليوم على الساعة 12:25',     'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),       'اليوم على الساعة 13:00',     'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),       'غدا على الساعة 12:00',      'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'اليوم على الساعة 11:00',     'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'أمس على الساعة 12:00',     'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2011, 11, 31]).format('w ww wo'), '1 01 1', 'Dec 31 2011 should be week 1');
        assert.equal(moment([2012,  0,  6]).format('w ww wo'), '1 01 1', 'Jan  6 2012 should be week 1');
        assert.equal(moment([2012,  0,  7]).format('w ww wo'), '2 02 2', 'Jan  7 2012 should be week 2');
        assert.equal(moment([2012,  0, 13]).format('w ww wo'), '2 02 2', 'Jan 13 2012 should be week 2');
        assert.equal(moment([2012,  0, 14]).format('w ww wo'), '3 03 3', 'Jan 14 2012 should be week 3');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('ar-sa');

    test('parse', function (assert) {
        var tests = 'يناير:يناير_فبراير:فبراير_مارس:مارس_أبريل:أبريل_مايو:مايو_يونيو:يونيو_يوليو:يوليو_أغسطس:أغسطس_سبتمبر:سبتمبر_أكتوبر:أكتوبر_نوفمبر:نوفمبر_ديسمبر:ديسمبر'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1) + ' instead is month ' + moment(input, mmm).month());
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(':');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, MMMM Do YYYY, h:mm:ss a',      'الأحد، فبراير ١٤ ٢٠١٠، ٣:٢٥:٥٠ م'],
                ['ddd, hA',                            'أحد، ٣م'],
                ['M Mo MM MMMM MMM',                   '٢ ٢ ٠٢ فبراير فبراير'],
                ['YYYY YY',                            '٢٠١٠ ١٠'],
                ['D Do DD',                            '١٤ ١٤ ١٤'],
                ['d do dddd ddd dd',                   '٠ ٠ الأحد أحد ح'],
                ['DDD DDDo DDDD',                      '٤٥ ٤٥ ٠٤٥'],
                ['w wo ww',                            '٨ ٨ ٠٨'],
                ['h hh',                               '٣ ٠٣'],
                ['H HH',                               '١٥ ١٥'],
                ['m mm',                               '٢٥ ٢٥'],
                ['s ss',                               '٥٠ ٥٠'],
                ['a A',                                'م م'],
                ['[the] DDDo [day of the year]',       'the ٤٥ day of the year'],
                ['LT',                                 '١٥:٢٥'],
                ['LTS',                                '١٥:٢٥:٥٠'],
                ['L',                                  '١٤/٠٢/٢٠١٠'],
                ['LL',                                 '١٤ فبراير ٢٠١٠'],
                ['LLL',                                '١٤ فبراير ٢٠١٠ ١٥:٢٥'],
                ['LLLL',                               'الأحد ١٤ فبراير ٢٠١٠ ١٥:٢٥'],
                ['l',                                  '١٤/٢/٢٠١٠'],
                ['ll',                                 '١٤ فبراير ٢٠١٠'],
                ['lll',                                '١٤ فبراير ٢٠١٠ ١٥:٢٥'],
                ['llll',                               'أحد ١٤ فبراير ٢٠١٠ ١٥:٢٥']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '١', '1');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '٢', '2');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '٣', '3');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '٤', '4');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '٥', '5');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '٦', '6');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '٧', '7');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '٨', '8');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '٩', '9');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '١٠', '10');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '١١', '11');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '١٢', '12');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '١٣', '13');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '١٤', '14');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '١٥', '15');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '١٦', '16');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '١٧', '17');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '١٨', '18');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '١٩', '19');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '٢٠', '20');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '٢١', '21');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '٢٢', '22');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '٢٣', '23');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '٢٤', '24');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '٢٥', '25');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '٢٦', '26');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '٢٧', '27');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '٢٨', '28');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '٢٩', '29');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '٣٠', '30');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '٣١', '31');
    });

    test('format month', function (assert) {
        var expected = 'يناير يناير_فبراير فبراير_مارس مارس_أبريل أبريل_مايو مايو_يونيو يونيو_يوليو يوليو_أغسطس أغسطس_سبتمبر سبتمبر_أكتوبر أكتوبر_نوفمبر نوفمبر_ديسمبر ديسمبر'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'الأحد أحد ح_الإثنين إثنين ن_الثلاثاء ثلاثاء ث_الأربعاء أربعاء ر_الخميس خميس خ_الجمعة جمعة ج_السبت سبت س'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'ثوان', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'دقيقة',      '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'دقيقة',      '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '٢ دقائق',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '٤٤ دقائق',    '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'ساعة',       '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'ساعة',       '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '٢ ساعات',       '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '٥ ساعات',       '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '٢١ ساعات',      '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'يوم',         '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'يوم',         '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '٢ أيام',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'يوم',         '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '٥ أيام',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '٢٥ أيام',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'شهر',       '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'شهر',       '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  'شهر',       '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '٢ أشهر',      '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '٢ أشهر',      '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '٣ أشهر',      '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'شهر',       '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '٥ أشهر',      '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'سنة',        '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '٢ سنوات',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'سنة',        '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '٥ سنوات',       '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'في ثوان',  'prefix');
        assert.equal(moment(0).from(30000), 'منذ ثوان', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'منذ ثوان',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'في ثوان', 'in a few seconds');
        assert.equal(moment().add({d: 5}).fromNow(), 'في ٥ أيام', 'in 5 days');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'اليوم على الساعة ١٢:٠٠',     'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'اليوم على الساعة ١٢:٢٥',     'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),       'اليوم على الساعة ١٣:٠٠',     'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),       'غدا على الساعة ١٢:٠٠',       'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'اليوم على الساعة ١١:٠٠',     'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'أمس على الساعة ١٢:٠٠',      'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [على الساعة] LT'),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('weeks year starting wednesday custom', function (assert) {
        assert.equal(moment('2003 1 6', 'gggg w d').format('YYYY-MM-DD'), '٢٠٠٢-١٢-٢٨', 'Week 1 of 2003 should be Dec 28 2002');
        assert.equal(moment('2003 1 0', 'gggg w e').format('YYYY-MM-DD'), '٢٠٠٢-١٢-٢٨', 'Week 1 of 2003 should be Dec 28 2002');
        assert.equal(moment('2003 1 6', 'gggg w d').format('gggg w d'), '٢٠٠٣ ١ ٦', 'Saturday of week 1 of 2003 parsed should be formatted as 2003 1 6');
        assert.equal(moment('2003 1 0', 'gggg w e').format('gggg w e'), '٢٠٠٣ ١ ٠', '1st day of week 1 of 2003 parsed should be formatted as 2003 1 0');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2011, 11, 31]).format('w ww wo'), '١ ٠١ ١', 'Dec 31 2011 should be week 1');
        assert.equal(moment([2012,  0,  6]).format('w ww wo'), '١ ٠١ ١', 'Jan  6 2012 should be week 1');
        assert.equal(moment([2012,  0,  7]).format('w ww wo'), '٢ ٠٢ ٢', 'Jan  7 2012 should be week 2');
        assert.equal(moment([2012,  0, 13]).format('w ww wo'), '٢ ٠٢ ٢', 'Jan 13 2012 should be week 2');
        assert.equal(moment([2012,  0, 14]).format('w ww wo'), '٣ ٠٣ ٣', 'Jan 14 2012 should be week 3');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('ar-tn');

    test('parse', function (assert) {
        var tests = 'جانفي:جانفي_فيفري:فيفري_مارس:مارس_أفريل:أفريل_ماي:ماي_جوان:جوان_جويلية:جويلية_أوت:أوت_سبتمبر:سبتمبر_أكتوبر:أكتوبر_نوفمبر:نوفمبر_ديسمبر:ديسمبر'.split('_'),
            i;

        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(':');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, MMMM Do YYYY, h:mm:ss a', 'الأحد, فيفري 14 2010, 3:25:50 pm'],
                ['ddd, hA', 'أحد, 3PM'],
                ['M Mo MM MMMM MMM', '2 2 02 فيفري فيفري'],
                ['YYYY YY', '2010 10'],
                ['D Do DD', '14 14 14'],
                ['d do dddd ddd dd', '0 0 الأحد أحد ح'],
                ['DDD DDDo DDDD', '45 45 045'],
                ['w wo ww', '6 6 06'],
                ['h hh', '3 03'],
                ['H HH', '15 15'],
                ['m mm', '25 25'],
                ['s ss', '50 50'],
                ['a A', 'pm PM'],
                ['[the] DDDo [day of the year]', 'the 45 day of the year'],
                ['LT', '15:25'],
                ['LTS', '15:25:50'],
                ['L', '14/02/2010'],
                ['LL', '14 فيفري 2010'],
                ['LLL', '14 فيفري 2010 15:25'],
                ['LLLL', 'الأحد 14 فيفري 2010 15:25'],
                ['l', '14/2/2010'],
                ['ll', '14 فيفري 2010'],
                ['lll', '14 فيفري 2010 15:25'],
                ['llll', 'أحد 14 فيفري 2010 15:25']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '1', '1');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '2', '2');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '3', '3');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '4', '4');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '5', '5');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '6', '6');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '7', '7');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '8', '8');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '9', '9');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '10', '10');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '11', '11');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '12', '12');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '13', '13');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '14', '14');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '15', '15');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '16', '16');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '17', '17');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '18', '18');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '19', '19');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '20', '20');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '21', '21');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '22', '22');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '23', '23');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '24', '24');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '25', '25');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '26', '26');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '27', '27');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '28', '28');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '29', '29');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '30', '30');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '31', '31');
    });

    test('format month', function (assert) {
        var expected = 'جانفي جانفي_فيفري فيفري_مارس مارس_أفريل أفريل_ماي ماي_جوان جوان_جويلية جويلية_أوت أوت_سبتمبر سبتمبر_أكتوبر أكتوبر_نوفمبر نوفمبر_ديسمبر ديسمبر'.split('_'),
            i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'الأحد أحد ح_الإثنين إثنين ن_الثلاثاء ثلاثاء ث_الأربعاء أربعاء ر_الخميس خميس خ_الجمعة جمعة ج_السبت سبت س'.split('_'),
            i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({
            s: 44
        }), true), 'ثوان', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            s: 45
        }), true), 'دقيقة', '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            s: 89
        }), true), 'دقيقة', '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            s: 90
        }), true), '2 دقائق', '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            m: 44
        }), true), '44 دقائق', '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            m: 45
        }), true), 'ساعة', '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            m: 89
        }), true), 'ساعة', '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            m: 90
        }), true), '2 ساعات', '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            h: 5
        }), true), '5 ساعات', '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            h: 21
        }), true), '21 ساعات', '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            h: 22
        }), true), 'يوم', '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            h: 35
        }), true), 'يوم', '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            h: 36
        }), true), '2 أيام', '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 1
        }), true), 'يوم', '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 5
        }), true), '5 أيام', '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 25
        }), true), '25 أيام', '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 26
        }), true), 'شهر', '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 30
        }), true), 'شهر', '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 43
        }), true), 'شهر', '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 46
        }), true), '2 أشهر', '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 74
        }), true), '2 أشهر', '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 76
        }), true), '3 أشهر', '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            M: 1
        }), true), 'شهر', '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            M: 5
        }), true), '5 أشهر', '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 345
        }), true), 'سنة', '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            d: 548
        }), true), '2 سنوات', '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            y: 1
        }), true), 'سنة', '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({
            y: 5
        }), true), '5 سنوات', '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'في ثوان', 'prefix');
        assert.equal(moment(0).from(30000), 'منذ ثوان', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'منذ ثوان', 'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({
            s: 30
        }).fromNow(), 'في ثوان', 'in a few seconds');
        assert.equal(moment().add({
            d: 5
        }).fromNow(), 'في 5 أيام', 'in 5 days');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                  'اليوم على الساعة 12:00', 'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),     'اليوم على الساعة 12:25', 'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),      'اليوم على الساعة 13:00', 'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),      'غدا على الساعة 12:00',  'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(), 'اليوم على الساعة 11:00', 'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(), 'أمس على الساعة 12:00',  'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({
                d: i
            });
            assert.equal(m.calendar(), m.format('dddd [على الساعة] LT'), 'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(), m.format('dddd [على الساعة] LT'), 'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(), m.format('dddd [على الساعة] LT'), 'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().subtract({
                d: i
            });
            assert.equal(m.calendar(), m.format('dddd [على الساعة] LT'), 'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(), m.format('dddd [على الساعة] LT'), 'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(), m.format('dddd [على الساعة] LT'), 'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({
                w: 1
            }),
            weeksFromNow = moment().add({
                w: 1
            });

        assert.equal(weeksAgo.calendar(), weeksAgo.format('L'), '1 week ago');
        assert.equal(weeksFromNow.calendar(), weeksFromNow.format('L'), 'in 1 week');

        weeksAgo = moment().subtract({
            w: 2
        });
        weeksFromNow = moment().add({
            w: 2
        });

        assert.equal(weeksAgo.calendar(), weeksAgo.format('L'), '2 weeks ago');
        assert.equal(weeksFromNow.calendar(), weeksFromNow.format('L'), 'in 2 weeks');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2012, 0,  1]).format('w ww wo'), '52 52 52', 'Jan  1 2012 should be week 52');
        assert.equal(moment([2012, 0,  2]).format('w ww wo'), '1 01 1', 'Jan  2 2012 should be week 1');
        assert.equal(moment([2012, 0,  8]).format('w ww wo'), '1 01 1', 'Jan  8 2012 should be week 1');
        assert.equal(moment([2012, 0,  9]).format('w ww wo'),   '2 02 2', 'Jan  9 2012 should be week 2');
        assert.equal(moment([2012, 0, 15]).format('w ww wo'),   '2 02 2', 'Jan 15 2012 should be week 2');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('ar');

    var months = [
        'كانون الثاني يناير',
        'شباط فبراير',
        'آذار مارس',
        'نيسان أبريل',
        'أيار مايو',
        'حزيران يونيو',
        'تموز يوليو',
        'آب أغسطس',
        'أيلول سبتمبر',
        'تشرين الأول أكتوبر',
        'تشرين الثاني نوفمبر',
        'كانون الأول ديسمبر'
    ];

    test('parse', function (assert) {
        var tests = months, i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1) + ' instead is month ' + moment(input, mmm).month());
        }
        for (i = 0; i < 12; i++) {
            equalTest(tests[i], 'MMM', i);
            equalTest(tests[i], 'MMM', i);
            equalTest(tests[i], 'MMMM', i);
            equalTest(tests[i], 'MMMM', i);
            equalTest(tests[i].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, MMMM Do YYYY, h:mm:ss a',      'الأحد، شباط فبراير ١٤ ٢٠١٠، ٣:٢٥:٥٠ م'],
                ['ddd, hA',                            'أحد، ٣م'],
                ['M Mo MM MMMM MMM',                   '٢ ٢ ٠٢ شباط فبراير شباط فبراير'],
                ['YYYY YY',                            '٢٠١٠ ١٠'],
                ['D Do DD',                            '١٤ ١٤ ١٤'],
                ['d do dddd ddd dd',                   '٠ ٠ الأحد أحد ح'],
                ['DDD DDDo DDDD',                      '٤٥ ٤٥ ٠٤٥'],
                ['w wo ww',                            '٨ ٨ ٠٨'],
                ['h hh',                               '٣ ٠٣'],
                ['H HH',                               '١٥ ١٥'],
                ['m mm',                               '٢٥ ٢٥'],
                ['s ss',                               '٥٠ ٥٠'],
                ['a A',                                'م م'],
                ['[the] DDDo [day of the year]',       'the ٤٥ day of the year'],
                ['LT',                                 '١٥:٢٥'],
                ['LTS',                                '١٥:٢٥:٥٠'],
                ['L',                                  '١٤/\u200f٢/\u200f٢٠١٠'],
                ['LL',                                 '١٤ شباط فبراير ٢٠١٠'],
                ['LLL',                                '١٤ شباط فبراير ٢٠١٠ ١٥:٢٥'],
                ['LLLL',                               'الأحد ١٤ شباط فبراير ٢٠١٠ ١٥:٢٥'],
                ['l',                                  '١٤/\u200f٢/\u200f٢٠١٠'],
                ['ll',                                 '١٤ شباط فبراير ٢٠١٠'],
                ['lll',                                '١٤ شباط فبراير ٢٠١٠ ١٥:٢٥'],
                ['llll',                               'أحد ١٤ شباط فبراير ٢٠١٠ ١٥:٢٥']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '١', '1');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '٢', '2');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '٣', '3');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '٤', '4');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '٥', '5');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '٦', '6');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '٧', '7');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '٨', '8');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '٩', '9');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '١٠', '10');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '١١', '11');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '١٢', '12');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '١٣', '13');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '١٤', '14');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '١٥', '15');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '١٦', '16');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '١٧', '17');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '١٨', '18');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '١٩', '19');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '٢٠', '20');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '٢١', '21');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '٢٢', '22');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '٢٣', '23');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '٢٤', '24');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '٢٥', '25');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '٢٦', '26');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '٢٧', '27');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '٢٨', '28');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '٢٩', '29');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '٣٠', '30');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '٣١', '31');
    });

    test('format month', function (assert) {
        var expected = months, i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM'), expected[i], expected[i]);
            assert.equal(moment([2011, i, 1]).format('MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'الأحد أحد ح_الإثنين إثنين ن_الثلاثاء ثلاثاء ث_الأربعاء أربعاء ر_الخميس خميس خ_الجمعة جمعة ج_السبت سبت س'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  '٤٤ ثانية', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'دقيقة واحدة',      '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'دقيقة واحدة',      '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  'دقيقتان',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '٤٤ دقيقة',    '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'ساعة واحدة',       '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'ساعة واحدة',       '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  'ساعتان',       '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '٥ ساعات',       '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '٢١ ساعة',      '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'يوم واحد',         '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'يوم واحد',         '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  'يومان',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'يوم واحد',         '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '٥ أيام',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '٢٥ يومًا',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'شهر واحد',       '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'شهر واحد',       '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  'شهر واحد',       '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  'شهران',      '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  'شهران',      '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '٣ أشهر',      '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'شهر واحد',       '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '٥ أشهر',      '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'عام واحد',        '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), 'عامان',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'عام واحد',        '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '٥ أعوام',       '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'بعد ٣٠ ثانية',  'prefix');
        assert.equal(moment(0).from(30000), 'منذ ٣٠ ثانية', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'منذ ثانية واحدة',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'بعد ٣٠ ثانية', 'in a few seconds');
        assert.equal(moment().add({d: 5}).fromNow(), 'بعد ٥ أيام', 'in 5 days');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'اليوم عند الساعة ١٢:٠٠',     'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'اليوم عند الساعة ١٢:٢٥',     'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),       'اليوم عند الساعة ١٣:٠٠',     'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),       'غدًا عند الساعة ١٢:٠٠',      'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'اليوم عند الساعة ١١:٠٠',     'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'أمس عند الساعة ١٢:٠٠',       'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('dddd [عند الساعة] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [عند الساعة] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [عند الساعة] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format('dddd [عند الساعة] LT'),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [عند الساعة] LT'),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [عند الساعة] LT'),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('weeks year starting wednesday custom', function (assert) {
        assert.equal(moment('2003 1 6', 'gggg w d').format('YYYY-MM-DD'), '٢٠٠٢-١٢-٢٨', 'Week 1 of 2003 should be Dec 28 2002');
        assert.equal(moment('2003 1 0', 'gggg w e').format('YYYY-MM-DD'), '٢٠٠٢-١٢-٢٨', 'Week 1 of 2003 should be Dec 28 2002');
        assert.equal(moment('2003 1 6', 'gggg w d').format('gggg w d'), '٢٠٠٣ ١ ٦', 'Saturday of week 1 of 2003 parsed should be formatted as 2003 1 6');
        assert.equal(moment('2003 1 0', 'gggg w e').format('gggg w e'), '٢٠٠٣ ١ ٠', '1st day of week 1 of 2003 parsed should be formatted as 2003 1 0');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2011, 11, 31]).format('w ww wo'), '١ ٠١ ١', 'Dec 31 2011 should be week 1');
        assert.equal(moment([2012,  0,  6]).format('w ww wo'), '١ ٠١ ١', 'Jan  6 2012 should be week 1');
        assert.equal(moment([2012,  0,  7]).format('w ww wo'), '٢ ٠٢ ٢', 'Jan  7 2012 should be week 2');
        assert.equal(moment([2012,  0, 13]).format('w ww wo'), '٢ ٠٢ ٢', 'Jan 13 2012 should be week 2');
        assert.equal(moment([2012,  0, 14]).format('w ww wo'), '٣ ٠٣ ٣', 'Jan 14 2012 should be week 3');
    });

    test('no leading zeros in long date formats', function (assert) {
        var i, j, longDateStr, shortDateStr;
        for (i = 1; i <= 9; ++i) {
            for (j = 1; j <= 9; ++j) {
                longDateStr = moment([2014, i, j]).format('L');
                shortDateStr = moment([2014, i, j]).format('l');
                assert.equal(longDateStr, shortDateStr, 'should not have leading zeros in month or day');
            }
        }
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('az');

    test('parse', function (assert) {
        var tests = 'yanvar yan_fevral fev_mart mar_Aprel apr_may may_iyun iyn_iyul iyl_Avqust avq_sentyabr sen_oktyabr okt_noyabr noy_dekabr dek'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(' ');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, D MMMM YYYY, HH:mm:ss',        'Bazar, 14 fevral 2010, 15:25:50'],
                ['ddd, A h',                           'Baz, gündüz 3'],
                ['M Mo MM MMMM MMM',                   '2 2-nci 02 fevral fev'],
                ['YYYY YY',                            '2010 10'],
                ['D Do DD',                            '14 14-üncü 14'],
                ['d do dddd ddd dd',                   '0 0-ıncı Bazar Baz Bz'],
                ['DDD DDDo DDDD',                      '45 45-inci 045'],
                ['w wo ww',                            '7 7-nci 07'],
                ['h hh',                               '3 03'],
                ['H HH',                               '15 15'],
                ['m mm',                               '25 25'],
                ['s ss',                               '50 50'],
                ['a A',                                'gündüz gündüz'],
                ['[ilin] DDDo [günü]',                 'ilin 45-inci günü'],
                ['LT',                                 '15:25'],
                ['LTS',                                '15:25:50'],
                ['L',                                  '14.02.2010'],
                ['LL',                                 '14 fevral 2010'],
                ['LLL',                                '14 fevral 2010 15:25'],
                ['LLLL',                               'Bazar, 14 fevral 2010 15:25'],
                ['l',                                  '14.2.2010'],
                ['ll',                                 '14 fev 2010'],
                ['lll',                                '14 fev 2010 15:25'],
                ['llll',                               'Baz, 14 fev 2010 15:25']
            ],
            DDDo = [
                [359, '360-ıncı'],
                [199, '200-üncü'],
                [149, '150-nci']
            ],
            dt = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            DDDoDt,
            i;

        for (i = 0; i < a.length; i++) {
            assert.equal(dt.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
        for (i = 0; i < DDDo.length; i++) {
            DDDoDt = moment([2010]);
            assert.equal(DDDoDt.add(DDDo[i][0], 'days').format('DDDo'), DDDo[i][1], DDDo[i][0] + ' ---> ' + DDDo[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '1-inci', '1st');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '2-nci', '2nd');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '3-üncü', '3rd');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '4-üncü', '4th');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '5-inci', '5th');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '6-ncı', '6th');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '7-nci', '7th');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '8-inci', '8th');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '9-uncu', '9th');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '10-uncu', '10th');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '11-inci', '11th');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '12-nci', '12th');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '13-üncü', '13th');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '14-üncü', '14th');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '15-inci', '15th');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '16-ncı', '16th');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '17-nci', '17th');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '18-inci', '18th');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '19-uncu', '19th');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '20-nci', '20th');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '21-inci', '21th');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '22-nci', '22th');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '23-üncü', '23th');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '24-üncü', '24th');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '25-inci', '25th');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '26-ncı', '26th');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '27-nci', '27th');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '28-inci', '28th');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '29-uncu', '29th');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '30-uncu', '30th');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '31-inci', '31st');
    });

    test('format month', function (assert) {
        var expected = 'yanvar yan_fevral fev_mart mar_aprel apr_may may_iyun iyn_iyul iyl_avqust avq_sentyabr sen_oktyabr okt_noyabr noy_dekabr dek'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'Bazar Baz Bz_Bazar ertəsi BzE BE_Çərşənbə axşamı ÇAx ÇA_Çərşənbə Çər Çə_Cümə axşamı CAx CA_Cümə Cüm Cü_Şənbə Şən Şə'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'birneçə saniyyə', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'bir dəqiqə',      '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'bir dəqiqə',      '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '2 dəqiqə',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '44 dəqiqə',    '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'bir saat',       '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'bir saat',       '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '2 saat',       '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '5 saat',       '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '21 saat',      '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'bir gün',         '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'bir gün',         '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '2 gün',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'bir gün',         '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '5 gün',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '25 gün',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'bir ay',       '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'bir ay',       '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '2 ay',      '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '2 ay',      '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '3 ay',      '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'bir ay',       '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '5 ay',      '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'bir il',        '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '2 il',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'bir il',        '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '5 il',       '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'birneçə saniyyə sonra',  'prefix');
        assert.equal(moment(0).from(30000), 'birneçə saniyyə əvvəl', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'birneçə saniyyə əvvəl',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'birneçə saniyyə sonra', 'in a few seconds');
        assert.equal(moment().add({d: 5}).fromNow(), '5 gün sonra', 'in 5 days');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'bugün saat 12:00',     'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'bugün saat 12:25',     'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),       'bugün saat 13:00',     'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),       'sabah saat 12:00',     'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'bugün saat 11:00',     'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'dünən 12:00',          'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('[gələn həftə] dddd [saat] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('[gələn həftə] dddd [saat] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('[gələn həftə] dddd [saat] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format('[keçən həftə] dddd [saat] LT'),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('[keçən həftə] dddd [saat] LT'),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('[keçən həftə] dddd [saat] LT'),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2011, 11, 26]).format('w ww wo'), '1 01 1-inci', 'Dec 26 2011 should be week 1');
        assert.equal(moment([2012,  0,  1]).format('w ww wo'), '1 01 1-inci', 'Jan  1 2012 should be week 1');
        assert.equal(moment([2012,  0,  2]).format('w ww wo'), '2 02 2-nci', 'Jan  2 2012 should be week 2');
        assert.equal(moment([2012,  0,  8]).format('w ww wo'), '2 02 2-nci', 'Jan  8 2012 should be week 2');
        assert.equal(moment([2012,  0,  9]).format('w ww wo'), '3 03 3-üncü', 'Jan  9 2012 should be week 3');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('be');

    test('parse', function (assert) {
        var tests = 'студзень студ_люты лют_сакавік сак_красавік крас_травень трав_чэрвень чэрв_ліпень ліп_жнівень жнів_верасень вер_кастрычнік каст_лістапад ліст_снежань снеж'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(' ');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, Do MMMM YYYY, HH:mm:ss',       'нядзеля, 14-га лютага 2010, 15:25:50'],
                ['ddd, h A',                           'нд, 3 дня'],
                ['M Mo MM MMMM MMM',                   '2 2-і 02 люты лют'],
                ['YYYY YY',                            '2010 10'],
                ['D Do DD',                            '14 14-га 14'],
                ['d do dddd ddd dd',                   '0 0-ы нядзеля нд нд'],
                ['DDD DDDo DDDD',                      '45 45-ы 045'],
                ['w wo ww',                            '7 7-ы 07'],
                ['h hh',                               '3 03'],
                ['H HH',                               '15 15'],
                ['m mm',                               '25 25'],
                ['s ss',                               '50 50'],
                ['a A',                                'дня дня'],
                ['DDDo [дзень года]',                   '45-ы дзень года'],
                ['LT',                                 '15:25'],
                ['LTS',                                '15:25:50'],
                ['L',                                  '14.02.2010'],
                ['LL',                                 '14 лютага 2010 г.'],
                ['LLL',                                '14 лютага 2010 г., 15:25'],
                ['LLLL',                               'нядзеля, 14 лютага 2010 г., 15:25'],
                ['l',                                  '14.2.2010'],
                ['ll',                                 '14 лют 2010 г.'],
                ['lll',                                '14 лют 2010 г., 15:25'],
                ['llll',                               'нд, 14 лют 2010 г., 15:25']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format meridiem', function (assert) {
        assert.equal(moment([2012, 11, 28, 0, 0]).format('A'), 'ночы', 'night');
        assert.equal(moment([2012, 11, 28, 3, 59]).format('A'), 'ночы', 'night');
        assert.equal(moment([2012, 11, 28, 4, 0]).format('A'), 'раніцы', 'morning');
        assert.equal(moment([2012, 11, 28, 11, 59]).format('A'), 'раніцы', 'morning');
        assert.equal(moment([2012, 11, 28, 12, 0]).format('A'), 'дня', 'afternoon');
        assert.equal(moment([2012, 11, 28, 16, 59]).format('A'), 'дня', 'afternoon');
        assert.equal(moment([2012, 11, 28, 17, 0]).format('A'), 'вечара', 'evening');
        assert.equal(moment([2012, 11, 28, 23, 59]).format('A'), 'вечара', 'evening');
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '1-ы', '1-ы');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '2-і', '2-і');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '3-і', '3-і');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '4-ы', '4-ы');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '5-ы', '5-ы');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '6-ы', '6-ы');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '7-ы', '7-ы');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '8-ы', '8-ы');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '9-ы', '9-ы');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '10-ы', '10-ы');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '11-ы', '11-ы');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '12-ы', '12-ы');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '13-ы', '13-ы');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '14-ы', '14-ы');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '15-ы', '15-ы');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '16-ы', '16-ы');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '17-ы', '17-ы');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '18-ы', '18-ы');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '19-ы', '19-ы');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '20-ы', '20-ы');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '21-ы', '21-ы');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '22-і', '22-і');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '23-і', '23-і');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '24-ы', '24-ы');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '25-ы', '25-ы');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '26-ы', '26-ы');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '27-ы', '27-ы');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '28-ы', '28-ы');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '29-ы', '29-ы');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '30-ы', '30-ы');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '31-ы', '31-ы');
    });

    test('format month', function (assert) {
        var expected = 'студзень студ_люты лют_сакавік сак_красавік крас_травень трав_чэрвень чэрв_ліпень ліп_жнівень жнів_верасень вер_кастрычнік каст_лістапад ліст_снежань снеж'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format month case', function (assert) {
        var months = {
            'nominative': 'студзень_люты_сакавік_красавік_травень_чэрвень_ліпень_жнівень_верасень_кастрычнік_лістапад_снежань'.split('_'),
            'accusative': 'студзеня_лютага_сакавіка_красавіка_траўня_чэрвеня_ліпеня_жніўня_верасня_кастрычніка_лістапада_снежня'.split('_')
        }, i;
        for (i = 0; i < 12; i++) {
            assert.equal(moment([2011, i, 1]).format('D MMMM'), '1 ' + months.accusative[i], '1 ' + months.accusative[i]);
            assert.equal(moment([2011, i, 1]).format('MMMM'), months.nominative[i], '1 ' + months.nominative[i]);
        }
    });

    test('format month case with escaped symbols', function (assert) {
        var months = {
            'nominative': 'студзень_люты_сакавік_красавік_травень_чэрвень_ліпень_жнівень_верасень_кастрычнік_лістапад_снежань'.split('_'),
            'accusative': 'студзеня_лютага_сакавіка_красавіка_траўня_чэрвеня_ліпеня_жніўня_верасня_кастрычніка_лістапада_снежня'.split('_')
        }, i;
        for (i = 0; i < 12; i++) {
            assert.equal(moment([2013, i, 1]).format('D[] MMMM'), '1 ' + months.accusative[i], '1 ' + months.accusative[i]);
            assert.equal(moment([2013, i, 1]).format('[<i>]D[</i>] [<b>]MMMM[</b>]'), '<i>1</i> <b>' + months.accusative[i] + '</b>', '1 <b>' + months.accusative[i] + '</b>');
            assert.equal(moment([2013, i, 1]).format('D[-ы дзень] MMMM'), '1-ы дзень ' + months.accusative[i], '1-ы дзень ' + months.accusative[i]);
            assert.equal(moment([2013, i, 1]).format('D, MMMM'), '1, ' + months.nominative[i], '1, ' + months.nominative[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'нядзеля нд нд_панядзелак пн пн_аўторак ат ат_серада ср ср_чацвер чц чц_пятніца пт пт_субота сб сб'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'некалькі секунд',    '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'хвіліна',   '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'хвіліна',   '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '2 хвіліны',  '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 31}), true),  '31 хвіліна',  '31 minutes = 31 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '44 хвіліны', '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'гадзіна',    '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'гадзіна',    '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '2 гадзіны',    '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '5 гадзін',    '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '21 гадзіна',   '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'дзень',      '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'дзень',      '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '2 дні',     '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'дзень',      '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '5 дзён',     '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 11}), true),  '11 дзён',     '11 days = 11 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 21}), true),  '21 дзень',     '21 days = 21 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '25 дзён',    '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'месяц',    '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'месяц',    '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  'месяц',    '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '2 месяцы',   '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '2 месяцы',   '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '3 месяцы',   '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'месяц',    '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '5 месяцаў',   '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'год',     '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '2 гады',    '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'год',     '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '5 гадоў',    '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'праз некалькі секунд', 'prefix');
        assert.equal(moment(0).from(30000), 'некалькі секунд таму', 'suffix');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'праз некалькі секунд', 'in a few seconds');
        assert.equal(moment().add({d: 5}).fromNow(), 'праз 5 дзён', 'in 5 days');
        assert.equal(moment().add({m: 31}).fromNow(), 'праз 31 хвіліну', 'in 31 minutes = in 31 minutes');
        assert.equal(moment().subtract({m: 31}).fromNow(), '31 хвіліну таму', '31 minutes ago = 31 minutes ago');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'Сёння ў 12:00',     'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'Сёння ў 12:25',     'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),       'Сёння ў 13:00',     'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),       'Заўтра ў 12:00',    'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'Сёння ў 11:00',     'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'Учора ў 12:00',     'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        function makeFormat(d) {
            return '[У] dddd [ў] LT';
        }

        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;

        function makeFormat(d) {
            switch (d.day()) {
            case 0:
            case 3:
            case 5:
            case 6:
                return '[У мінулую] dddd [ў] LT';
            case 1:
            case 2:
            case 4:
                return '[У мінулы] dddd [ў] LT';
            }
        }

        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2011, 11, 26]).format('w ww wo'), '1 01 1-ы', 'Dec 26 2011 should be week 1');
        assert.equal(moment([2012,  0,  1]).format('w ww wo'), '1 01 1-ы', 'Jan  1 2012 should be week 1');
        assert.equal(moment([2012,  0,  2]).format('w ww wo'), '2 02 2-і', 'Jan  2 2012 should be week 2');
        assert.equal(moment([2012,  0,  8]).format('w ww wo'), '2 02 2-і', 'Jan  8 2012 should be week 2');
        assert.equal(moment([2012,  0,  9]).format('w ww wo'), '3 03 3-і', 'Jan  9 2012 should be week 3');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('bg');

    test('parse', function (assert) {
        var tests = 'януари янр_февруари фев_март мар_април апр_май май_юни юни_юли юли_август авг_септември сеп_октомври окт_ноември ное_декември дек'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(' ');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, MMMM Do YYYY, H:mm:ss',        'неделя, февруари 14-ти 2010, 15:25:50'],
                ['ddd, hA',                            'нед, 3PM'],
                ['M Mo MM MMMM MMM',                   '2 2-ри 02 февруари фев'],
                ['YYYY YY',                            '2010 10'],
                ['D Do DD',                            '14 14-ти 14'],
                ['d do dddd ddd dd',                   '0 0-ев неделя нед нд'],
                ['DDD DDDo DDDD',                      '45 45-ти 045'],
                ['w wo ww',                            '7 7-ми 07'],
                ['h hh',                               '3 03'],
                ['H HH',                               '15 15'],
                ['m mm',                               '25 25'],
                ['s ss',                               '50 50'],
                ['a A',                                'pm PM'],
                ['[the] DDDo [day of the year]',       'the 45-ти day of the year'],
                ['LT',                                 '15:25'],
                ['LTS',                                '15:25:50'],
                ['L',                                  '14.02.2010'],
                ['LL',                                 '14 февруари 2010'],
                ['LLL',                                '14 февруари 2010 15:25'],
                ['LLLL',                               'неделя, 14 февруари 2010 15:25'],
                ['l',                                  '14.2.2010'],
                ['ll',                                 '14 фев 2010'],
                ['lll',                                '14 фев 2010 15:25'],
                ['llll',                               'нед, 14 фев 2010 15:25']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '1-ви', '1-ви');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '2-ри', '2-ри');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '3-ти', '3-ти');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '4-ти', '4-ти');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '5-ти', '5-ти');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '6-ти', '6-ти');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '7-ми', '7-ми');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '8-ми', '8-ми');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '9-ти', '9-ти');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '10-ти', '10-ти');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '11-ти', '11-ти');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '12-ти', '12-ти');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '13-ти', '13-ти');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '14-ти', '14-ти');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '15-ти', '15-ти');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '16-ти', '16-ти');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '17-ти', '17-ти');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '18-ти', '18-ти');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '19-ти', '19-ти');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '20-ти', '20-ти');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '21-ви', '21-ви');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '22-ри', '22-ри');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '23-ти', '23-ти');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '24-ти', '24-ти');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '25-ти', '25-ти');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '26-ти', '26-ти');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '27-ми', '27-ми');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '28-ми', '28-ми');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '29-ти', '29-ти');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '30-ти', '30-ти');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '31-ви', '31-ви');
    });

    test('format month', function (assert) {
        var expected = 'януари янр_февруари фев_март мар_април апр_май май_юни юни_юли юли_август авг_септември сеп_октомври окт_ноември ное_декември дек'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'неделя нед нд_понеделник пон пн_вторник вто вт_сряда сря ср_четвъртък чет чт_петък пет пт_събота съб сб'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'няколко секунди', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'минута',          '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'минута',          '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '2 минути',        '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '44 минути',       '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'час',             '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'час',             '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '2 часа',          '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '5 часа',          '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '21 часа',         '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'ден',             '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'ден',             '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '2 дни',           '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'ден',             '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '5 дни',           '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '25 дни',          '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'месец',           '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'месец',           '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  'месец',           '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '2 месеца',        '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '2 месеца',        '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '3 месеца',        '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'месец',           '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '5 месеца',        '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'година',          '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '2 години',        '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'година',          '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '5 години',        '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'след няколко секунди',  'prefix');
        assert.equal(moment(0).from(30000), 'преди няколко секунди', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'преди няколко секунди',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'след няколко секунди', 'in a few seconds');
        assert.equal(moment().add({d: 5}).fromNow(), 'след 5 дни', 'in 5 days');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'Днес в 12:00',  'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'Днес в 12:25',  'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),       'Днес в 13:00',  'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),       'Утре в 12:00',  'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'Днес в 11:00',  'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'Вчера в 12:00', 'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('dddd [в] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [в] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [в] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;

        function makeFormat(d) {
            switch (d.day()) {
            case 0:
            case 3:
            case 6:
                return '[В изминалата] dddd [в] LT';
            case 1:
            case 2:
            case 4:
            case 5:
                return '[В изминалия] dddd [в] LT';
            }
        }

        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2011, 11, 26]).format('w ww wo'), '1 01 1-ви', 'Dec 26 2011 should be week 1');
        assert.equal(moment([2012,  0,  1]).format('w ww wo'), '1 01 1-ви', 'Jan  1 2012 should be week 1');
        assert.equal(moment([2012,  0,  2]).format('w ww wo'), '2 02 2-ри', 'Jan  2 2012 should be week 2');
        assert.equal(moment([2012,  0,  8]).format('w ww wo'), '2 02 2-ри', 'Jan  8 2012 should be week 2');
        assert.equal(moment([2012,  0,  9]).format('w ww wo'), '3 03 3-ти', 'Jan  9 2012 should be week 3');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('bn');

    test('parse', function (assert) {
        var tests = 'জানুয়ারী জানু_ফেবুয়ারী ফেব_মার্চ মার্চ_এপ্রিল এপর_মে মে_জুন জুন_জুলাই জুল_অগাস্ট অগ_সেপ্টেম্বর সেপ্ট_অক্টোবর অক্টো_নভেম্বর নভ_ডিসেম্বর ডিসেম্'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(' ');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, Do MMMM YYYY, a h:mm:ss সময়',  'রবিবার, ১৪ ফেবুয়ারী ২০১০, দুপুর ৩:২৫:৫০ সময়'],
                ['ddd, a h সময়',                       'রবি, দুপুর ৩ সময়'],
                ['M Mo MM MMMM MMM',                   '২ ২ ০২ ফেবুয়ারী ফেব'],
                ['YYYY YY',                            '২০১০ ১০'],
                ['D Do DD',                            '১৪ ১৪ ১৪'],
                ['d do dddd ddd dd',                   '০ ০ রবিবার রবি রব'],
                ['DDD DDDo DDDD',                      '৪৫ ৪৫ ০৪৫'],
                ['w wo ww',                            '৮ ৮ ০৮'],
                ['h hh',                               '৩ ০৩'],
                ['H HH',                               '১৫ ১৫'],
                ['m mm',                               '২৫ ২৫'],
                ['s ss',                               '৫০ ৫০'],
                ['a A',                                'দুপুর দুপুর'],
                ['LT',                                 'দুপুর ৩:২৫ সময়'],
                ['LTS',                                'দুপুর ৩:২৫:৫০ সময়'],
                ['L',                                  '১৪/০২/২০১০'],
                ['LL',                                 '১৪ ফেবুয়ারী ২০১০'],
                ['LLL',                                '১৪ ফেবুয়ারী ২০১০, দুপুর ৩:২৫ সময়'],
                ['LLLL',                               'রবিবার, ১৪ ফেবুয়ারী ২০১০, দুপুর ৩:২৫ সময়'],
                ['l',                                  '১৪/২/২০১০'],
                ['ll',                                 '১৪ ফেব ২০১০'],
                ['lll',                                '১৪ ফেব ২০১০, দুপুর ৩:২৫ সময়'],
                ['llll',                               'রবি, ১৪ ফেব ২০১০, দুপুর ৩:২৫ সময়']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '১', '১');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '২', '২');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '৩', '৩');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '৪', '৪');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '৫', '৫');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '৬', '৬');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '৭', '৭');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '৮', '৮');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '৯', '৯');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '১০', '১০');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '১১', '১১');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '১২', '১২');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '১৩', '১৩');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '১৪', '১৪');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '১৫', '১৫');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '১৬', '১৬');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '১৭', '১৭');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '১৮', '১৮');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '১৯', '১৯');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '২০', '২০');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '২১', '২১');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '২২', '২২');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '২৩', '২৩');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '২৪', '২৪');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '২৫', '২৫');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '২৬', '২৬');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '২৭', '২৭');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '২৮', '२৮');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '২৯', '২৯');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '৩০', '৩০');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '৩১', '৩১');
    });

    test('format month', function (assert) {
        var expected = 'জানুয়ারী জানু_ফেবুয়ারী ফেব_মার্চ মার্চ_এপ্রিল এপর_মে মে_জুন জুন_জুলাই জুল_অগাস্ট অগ_সেপ্টেম্বর সেপ্ট_অক্টোবর অক্টো_নভেম্বর নভ_ডিসেম্বর ডিসেম্'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'রবিবার রবি রব_সোমবার সোম সম_মঙ্গলবার মঙ্গল মঙ্গ_বুধবার বুধ বু_বৃহস্পত্তিবার বৃহস্পত্তি ব্রিহ_শুক্রবার শুক্র শু_শনিবার শনি শনি'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'কয়েক সেকেন্ড', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'এক মিনিট',      '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'এক মিনিট',      '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '২ মিনিট',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '৪৪ মিনিট',    '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'এক ঘন্টা',       '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'এক ঘন্টা',       '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '২ ঘন্টা',       '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '৫ ঘন্টা',       '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '২১ ঘন্টা',      '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'এক দিন',         '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'এক দিন',         '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '২ দিন',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'এক দিন',         '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '৫ দিন',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '২৫ দিন',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'এক মাস',       '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'এক মাস',       '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '২ মাস',      '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '২ মাস',      '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '৩ মাস',      '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'এক মাস',       '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '৫ মাস',      '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'এক বছর',        '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '২ বছর',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'এক বছর',        '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '৫ বছর',       '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'কয়েক সেকেন্ড পরে',  'prefix');
        assert.equal(moment(0).from(30000), 'কয়েক সেকেন্ড আগে', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'কয়েক সেকেন্ড আগে',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'কয়েক সেকেন্ড পরে', 'কয়েক সেকেন্ড পরে');
        assert.equal(moment().add({d: 5}).fromNow(), '৫ দিন পরে', '৫ দিন পরে');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'আজ দুপুর ১২:০০ সময়',       'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'আজ দুপুর ১২:২৫ সময়',       'Now plus 25 min');
        assert.equal(moment(a).add({h: 3}).calendar(),       'আজ দুপুর ৩:০০ সময়',        'Now plus 3 hours');
        assert.equal(moment(a).add({d: 1}).calendar(),       'আগামীকাল দুপুর ১২:০০ সময়', 'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'আজ দুপুর ১১:০০ সময়',       'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'গতকাল দুপুর ১২:০০ সময়',    'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('dddd[,] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd[,] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd[,] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;

        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format('[গত] dddd[,] LT'),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('[গত] dddd[,] LT'),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('[গত] dddd[,] LT'),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('meridiem', function (assert) {
        assert.equal(moment([2011, 2, 23,  2, 30]).format('a'), 'রাত', 'before dawn');
        assert.equal(moment([2011, 2, 23,  9, 30]).format('a'), 'সকাল', 'morning');
        assert.equal(moment([2011, 2, 23, 14, 30]).format('a'), 'দুপুর', 'during day');
        assert.equal(moment([2011, 2, 23, 17, 30]).format('a'), 'বিকাল', 'evening');
        assert.equal(moment([2011, 2, 23, 19, 30]).format('a'), 'বিকাল', 'late evening');
        assert.equal(moment([2011, 2, 23, 21, 20]).format('a'), 'রাত', 'night');

        assert.equal(moment([2011, 2, 23,  2, 30]).format('A'), 'রাত', 'before dawn');
        assert.equal(moment([2011, 2, 23,  9, 30]).format('A'), 'সকাল', 'morning');
        assert.equal(moment([2011, 2, 23, 14, 30]).format('A'), 'দুপুর', ' during day');
        assert.equal(moment([2011, 2, 23, 17, 30]).format('A'), 'বিকাল', 'evening');
        assert.equal(moment([2011, 2, 23, 19, 30]).format('A'), 'বিকাল', 'late evening');
        assert.equal(moment([2011, 2, 23, 21, 20]).format('A'), 'রাত', 'night');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2012, 0,  1]).format('w ww wo'), '১ ০১ ১', 'Jan  1 2012 should be week 1');
        assert.equal(moment([2012, 0,  7]).format('w ww wo'), '১ ০১ ১', 'Jan  7 2012 should be week 1');
        assert.equal(moment([2012, 0,  8]).format('w ww wo'), '২ ০২ ২', 'Jan  8 2012 should be week 2');
        assert.equal(moment([2012, 0, 14]).format('w ww wo'), '২ ০২ ২', 'Jan 14 2012 should be week 2');
        assert.equal(moment([2012, 0, 15]).format('w ww wo'), '৩ ০৩ ৩', 'Jan 15 2012 should be week 3');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('bo');

    test('parse', function (assert) {
        var tests = 'ཟླ་བ་དང་པོ ཟླ་བ་དང་པོ._ཟླ་བ་གཉིས་པ ཟླ་བ་གཉིས་པ_ཟླ་བ་གསུམ་པ ཟླ་བ་གསུམ་པ_ཟླ་བ་བཞི་པ ཟླ་བ་བཞི་པ_ཟླ་བ་ལྔ་པ ཟླ་བ་ལྔ་པ_ཟླ་བ་དྲུག་པ ཟླ་བ་དྲུག་པ_ཟླ་བ་བདུན་པ ཟླ་བ་བདུན་པ_ཟླ་བ་བརྒྱད་པ ཟླ་བ་བརྒྱད་པ_ཟླ་བ་དགུ་པ ཟླ་བ་དགུ་པ_ཟླ་བ་བཅུ་པ ཟླ་བ་བཅུ་པ_ཟླ་བ་བཅུ་གཅིག་པ ཟླ་བ་བཅུ་གཅིག་པ_ཟླ་བ་བཅུ་གཉིས་པ ཟླ་བ་བཅུ་གཉིས་པ'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(' ');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, Do MMMM YYYY, a h:mm:ss ལ་',  'གཟའ་ཉི་མ་, ༡༤ ཟླ་བ་གཉིས་པ ༢༠༡༠, ཉིན་གུང ༣:༢༥:༥༠ ལ་'],
                ['ddd, a h ལ་',                       'ཉི་མ་, ཉིན་གུང ༣ ལ་'],
                ['M Mo MM MMMM MMM',                   '༢ ༢ ༠༢ ཟླ་བ་གཉིས་པ ཟླ་བ་གཉིས་པ'],
                ['YYYY YY',                            '༢༠༡༠ ༡༠'],
                ['D Do DD',                            '༡༤ ༡༤ ༡༤'],
                ['d do dddd ddd dd',                   '༠ ༠ གཟའ་ཉི་མ་ ཉི་མ་ ཉི་མ་'],
                ['DDD DDDo DDDD',                      '༤༥ ༤༥ ༠༤༥'],
                ['w wo ww',                            '༨ ༨ ༠༨'],
                ['h hh',                               '༣ ༠༣'],
                ['H HH',                               '༡༥ ༡༥'],
                ['m mm',                               '༢༥ ༢༥'],
                ['s ss',                               '༥༠ ༥༠'],
                ['a A',                                'ཉིན་གུང ཉིན་གུང'],
                ['LT',                                 'ཉིན་གུང ༣:༢༥'],
                ['LTS',                                'ཉིན་གུང ༣:༢༥:༥༠'],
                ['L',                                  '༡༤/༠༢/༢༠༡༠'],
                ['LL',                                 '༡༤ ཟླ་བ་གཉིས་པ ༢༠༡༠'],
                ['LLL',                                '༡༤ ཟླ་བ་གཉིས་པ ༢༠༡༠, ཉིན་གུང ༣:༢༥'],
                ['LLLL',                               'གཟའ་ཉི་མ་, ༡༤ ཟླ་བ་གཉིས་པ ༢༠༡༠, ཉིན་གུང ༣:༢༥'],
                ['l',                                  '༡༤/༢/༢༠༡༠'],
                ['ll',                                 '༡༤ ཟླ་བ་གཉིས་པ ༢༠༡༠'],
                ['lll',                                '༡༤ ཟླ་བ་གཉིས་པ ༢༠༡༠, ཉིན་གུང ༣:༢༥'],
                ['llll',                               'ཉི་མ་, ༡༤ ཟླ་བ་གཉིས་པ ༢༠༡༠, ཉིན་གུང ༣:༢༥']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '༡', '༡');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '༢', '༢');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '༣', '༣');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '༤', '༤');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '༥', '༥');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '༦', '༦');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '༧', '༧');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '༨', '༨');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '༩', '༩');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '༡༠', '༡༠');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '༡༡', '༡༡');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '༡༢', '༡༢');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '༡༣', '༡༣');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '༡༤', '༡༤');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '༡༥', '༡༥');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '༡༦', '༡༦');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '༡༧', '༡༧');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '༡༨', '༡༨');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '༡༩', '༡༩');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '༢༠', '༢༠');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '༢༡', '༢༡');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '༢༢', '༢༢');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '༢༣', '༢༣');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '༢༤', '༢༤');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '༢༥', '༢༥');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '༢༦', '༢༦');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '༢༧', '༢༧');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '༢༨', '༢༨');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '༢༩', '༢༩');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '༣༠', '༣༠');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '༣༡', '༣༡');
    });

    test('format month', function (assert) {
        var expected = 'ཟླ་བ་དང་པོ ཟླ་བ་དང་པོ_ཟླ་བ་གཉིས་པ ཟླ་བ་གཉིས་པ_ཟླ་བ་གསུམ་པ ཟླ་བ་གསུམ་པ_ཟླ་བ་བཞི་པ ཟླ་བ་བཞི་པ_ཟླ་བ་ལྔ་པ ཟླ་བ་ལྔ་པ_ཟླ་བ་དྲུག་པ ཟླ་བ་དྲུག་པ_ཟླ་བ་བདུན་པ ཟླ་བ་བདུན་པ_ཟླ་བ་བརྒྱད་པ ཟླ་བ་བརྒྱད་པ_ཟླ་བ་དགུ་པ ཟླ་བ་དགུ་པ_ཟླ་བ་བཅུ་པ ཟླ་བ་བཅུ་པ_ཟླ་བ་བཅུ་གཅིག་པ ཟླ་བ་བཅུ་གཅིག་པ_ཟླ་བ་བཅུ་གཉིས་པ ཟླ་བ་བཅུ་གཉིས་པ'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'གཟའ་ཉི་མ་ ཉི་མ་ ཉི་མ་_གཟའ་ཟླ་བ་ ཟླ་བ་ ཟླ་བ་_གཟའ་མིག་དམར་ མིག་དམར་ མིག་དམར་_གཟའ་ལྷག་པ་ ལྷག་པ་ ལྷག་པ་_གཟའ་ཕུར་བུ ཕུར་བུ ཕུར་བུ_གཟའ་པ་སངས་ པ་སངས་ པ་སངས་_གཟའ་སྤེན་པ་ སྤེན་པ་ སྤེན་པ་'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'ལམ་སང', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'སྐར་མ་གཅིག',      '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'སྐར་མ་གཅིག',      '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '༢ སྐར་མ',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '༤༤ སྐར་མ',    '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'ཆུ་ཚོད་གཅིག',       '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'ཆུ་ཚོད་གཅིག',       '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '༢ ཆུ་ཚོད',       '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '༥ ཆུ་ཚོད',       '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '༢༡ ཆུ་ཚོད',      '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'ཉིན་གཅིག',         '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'ཉིན་གཅིག',         '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '༢ ཉིན་',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'ཉིན་གཅིག',         '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '༥ ཉིན་',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '༢༥ ཉིན་',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'ཟླ་བ་གཅིག',       '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'ཟླ་བ་གཅིག',       '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  'ཟླ་བ་གཅིག',       '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '༢ ཟླ་བ',      '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '༢ ཟླ་བ',      '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '༣ ཟླ་བ',      '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'ཟླ་བ་གཅིག',       '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '༥ ཟླ་བ',      '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'ལོ་གཅིག',        '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '༢ ལོ',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'ལོ་གཅིག',        '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '༥ ལོ',       '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'ལམ་སང ལ་',  'prefix');
        assert.equal(moment(0).from(30000), 'ལམ་སང སྔན་ལ', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'ལམ་སང སྔན་ལ',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'ལམ་སང ལ་', 'ལམ་སང ལ་');
        assert.equal(moment().add({d: 5}).fromNow(), '༥ ཉིན་ ལ་', '༥ ཉིན་ ལ་');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'དི་རིང ཉིན་གུང ༡༢:༠༠',  'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'དི་རིང ཉིན་གུང ༡༢:༢༥',  'Now plus 25 min');
        assert.equal(moment(a).add({h: 3}).calendar(),       'དི་རིང ཉིན་གུང ༣:༠༠',   'Now plus 3 hours');
        assert.equal(moment(a).add({d: 1}).calendar(),       'སང་ཉིན ཉིན་གུང ༡༢:༠༠',  'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'དི་རིང ཉིན་གུང ༡༡:༠༠',  'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'ཁ་སང ཉིན་གུང ༡༢:༠༠',    'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('[བདུན་ཕྲག་རྗེས་མ][,] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('[བདུན་ཕྲག་རྗེས་མ][,] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('[བདུན་ཕྲག་རྗེས་མ][,] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;

        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format('[བདུན་ཕྲག་མཐའ་མ] dddd[,] LT'),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('[བདུན་ཕྲག་མཐའ་མ] dddd[,] LT'),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('[བདུན་ཕྲག་མཐའ་མ] dddd[,] LT'),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('meridiem', function (assert) {
        assert.equal(moment([2011, 2, 23,  2, 30]).format('a'), 'མཚན་མོ', 'before dawn');
        assert.equal(moment([2011, 2, 23,  9, 30]).format('a'), 'ཞོགས་ཀས', 'morning');
        assert.equal(moment([2011, 2, 23, 14, 30]).format('a'), 'ཉིན་གུང', 'during day');
        assert.equal(moment([2011, 2, 23, 17, 30]).format('a'), 'དགོང་དག', 'evening');
        assert.equal(moment([2011, 2, 23, 19, 30]).format('a'), 'དགོང་དག', 'late evening');
        assert.equal(moment([2011, 2, 23, 21, 20]).format('a'), 'མཚན་མོ', 'night');

        assert.equal(moment([2011, 2, 23,  2, 30]).format('A'), 'མཚན་མོ', 'before dawn');
        assert.equal(moment([2011, 2, 23,  9, 30]).format('A'), 'ཞོགས་ཀས', 'morning');
        assert.equal(moment([2011, 2, 23, 14, 30]).format('A'), 'ཉིན་གུང', ' during day');
        assert.equal(moment([2011, 2, 23, 17, 30]).format('A'), 'དགོང་དག', 'evening');
        assert.equal(moment([2011, 2, 23, 19, 30]).format('A'), 'དགོང་དག', 'late evening');
        assert.equal(moment([2011, 2, 23, 21, 20]).format('A'), 'མཚན་མོ', 'night');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2012, 0,  1]).format('w ww wo'), '༡ ༠༡ ༡', 'Jan  1 2012 should be week 1');
        assert.equal(moment([2012, 0,  7]).format('w ww wo'), '༡ ༠༡ ༡', 'Jan  7 2012 should be week 1');
        assert.equal(moment([2012, 0,  8]).format('w ww wo'), '༢ ༠༢ ༢', 'Jan  8 2012 should be week 2');
        assert.equal(moment([2012, 0, 14]).format('w ww wo'), '༢ ༠༢ ༢', 'Jan 14 2012 should be week 2');
        assert.equal(moment([2012, 0, 15]).format('w ww wo'), '༣ ༠༣ ༣', 'Jan 15 2012 should be week 3');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('br');

    test('parse', function (assert) {
        var tests = 'Genver Gen_C\'hwevrer C\'hwe_Meurzh Meu_Ebrel Ebr_Mae Mae_Mezheven Eve_Gouere Gou_Eost Eos_Gwengolo Gwe_Here Her_Du Du_Kerzu Ker'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(' ');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        moment.locale('br');
        var a = [
                ['dddd, MMMM Do YYYY, h:mm:ss a',      'Sul, C\'hwevrer 14vet 2010, 3:25:50 pm'],
                ['ddd, h A',                            'Sul, 3 PM'],
                ['M Mo MM MMMM MMM',                   '2 2vet 02 C\'hwevrer C\'hwe'],
                ['YYYY YY',                            '2010 10'],
                ['D Do DD',                            '14 14vet 14'],
                ['d do dddd ddd dd',                   '0 0vet Sul Sul Su'],
                ['DDD DDDo DDDD',                      '45 45vet 045'],
                ['w wo ww',                            '6 6vet 06'],
                ['h hh',                               '3 03'],
                ['H HH',                               '15 15'],
                ['m mm',                               '25 25'],
                ['s ss',                               '50 50'],
                ['DDDo [devezh] [ar] [vloaz]',       '45vet devezh ar vloaz'],
                ['L',                                  '14/02/2010'],
                ['LL',                                 '14 a viz C\'hwevrer 2010'],
                ['LLL',                                '14 a viz C\'hwevrer 2010 3e25 PM'],
                ['LLLL',                               'Sul, 14 a viz C\'hwevrer 2010 3e25 PM']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        moment.locale('br');
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '1añ', '1añ');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '2vet', '2vet');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '3vet', '3vet');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '4vet', '4vet');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '5vet', '5vet');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '6vet', '6vet');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '7vet', '7vet');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '8vet', '8vet');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '9vet', '9vet');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '10vet', '10vet');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '11vet', '11vet');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '12vet', '12vet');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '13vet', '13vet');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '14vet', '14vet');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '15vet', '15vet');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '16vet', '16vet');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '17vet', '17vet');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '18vet', '18vet');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '19vet', '19vet');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '20vet', '20vet');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '21vet', '21vet');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '22vet', '22vet');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '23vet', '23vet');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '24vet', '24vet');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '25vet', '25vet');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '26vet', '26vet');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '27vet', '27vet');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '28vet', '28vet');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '29vet', '29vet');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '30vet', '30vet');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '31vet', '31vet');
    });

    test('format month', function (assert) {
        moment.locale('br');
        var expected = 'Genver Gen_C\'hwevrer C\'hwe_Meurzh Meu_Ebrel Ebr_Mae Mae_Mezheven Eve_Gouere Gou_Eost Eos_Gwengolo Gwe_Here Her_Du Du_Kerzu Ker'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        moment.locale('br');
        var expected = 'Sul Sul Su_Lun Lun Lu_Meurzh Meu Me_Merc\'her Mer Mer_Yaou Yao Ya_Gwener Gwe Gw_Sadorn Sad Sa'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        moment.locale('br');
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'un nebeud segondennoù', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'ur vunutenn',      '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'ur vunutenn',      '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '2 vunutenn',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '44 munutenn',    '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'un eur',       '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'un eur',       '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '2 eur',       '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '5 eur',       '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '21 eur',      '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'un devezh',         '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'un devezh',         '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '2 zevezh',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'un devezh',         '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '5 devezh',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '25 devezh',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'ur miz',       '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'ur miz',       '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  'ur miz',       '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '2 viz',      '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '2 viz',      '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '3 miz',      '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'ur miz',       '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '5 miz',      '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'ur bloaz',        '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '2 vloaz',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'ur bloaz',        '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '5 bloaz',       '5 years = 5 years');
    });

    test('suffix', function (assert) {
        moment.locale('br');
        assert.equal(moment(30000).from(0), 'a-benn un nebeud segondennoù',  'prefix');
        assert.equal(moment(0).from(30000), 'un nebeud segondennoù \'zo', 'suffix');
    });

    test('now from now', function (assert) {
        moment.locale('br');
        assert.equal(moment().fromNow(), 'un nebeud segondennoù \'zo',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        moment.locale('br');
        assert.equal(moment().add({s: 30}).fromNow(), 'a-benn un nebeud segondennoù', 'in a few seconds');
        assert.equal(moment().add({d: 5}).fromNow(), 'a-benn 5 devezh', 'in 5 days');
    });

    test('calendar day', function (assert) {
        moment.locale('br');

        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'Hiziv da 12e00 PM',        'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'Hiziv da 12e25 PM',        'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),       'Hiziv da 1e00 PM',         'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),       'Warc\'hoazh da 12e00 PM',  'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'Hiziv da 11e00 AM',        'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'Dec\'h da 12e00 PM',       'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        moment.locale('br');

        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('dddd [da] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [da] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [da] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        moment.locale('br');

        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format('dddd [paset da] LT'),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [paset da] LT'),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [paset da] LT'),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        moment.locale('br');
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('special mutations for years', function (assert) {
        moment.locale('br');
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true), 'ur bloaz', 'mutation 1 year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 2}), true), '2 vloaz', 'mutation 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 3}), true), '3 bloaz', 'mutation 3 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 4}), true), '4 bloaz', 'mutation 4 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true), '5 bloaz', 'mutation 5 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 9}), true), '9 bloaz', 'mutation 9 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 10}), true), '10 vloaz', 'mutation 10 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 21}), true), '21 bloaz', 'mutation 21 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 22}), true), '22 vloaz', 'mutation 22 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 133}), true), '133 bloaz', 'mutation 133 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 148}), true), '148 vloaz', 'mutation 148 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 261}), true), '261 bloaz', 'mutation 261 years');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('bs');

    test('parse', function (assert) {
        var tests = 'januar jan._februar feb._mart mar._april apr._maj maj._juni jun._juli jul._august aug._septembar sep._oktobar okt._novembar nov._decembar dec.'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1) + ' inp ' + mmm);
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(' ');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, Do MMMM YYYY, h:mm:ss a',      'nedjelja, 14. februar 2010, 3:25:50 pm'],
                ['ddd, hA',                            'ned., 3PM'],
                ['M Mo MM MMMM MMM',                   '2 2. 02 februar feb.'],
                ['YYYY YY',                            '2010 10'],
                ['D Do DD',                            '14 14. 14'],
                ['d do dddd ddd dd',                   '0 0. nedjelja ned. ne'],
                ['DDD DDDo DDDD',                      '45 45. 045'],
                ['w wo ww',                            '7 7. 07'],
                ['h hh',                               '3 03'],
                ['H HH',                               '15 15'],
                ['m mm',                               '25 25'],
                ['s ss',                               '50 50'],
                ['a A',                                'pm PM'],
                ['[the] DDDo [day of the year]',       'the 45. day of the year'],
                ['LTS',                                '15:25:50'],
                ['L',                                  '14. 02. 2010'],
                ['LL',                                 '14. februar 2010'],
                ['LLL',                                '14. februar 2010 15:25'],
                ['LLLL',                               'nedjelja, 14. februar 2010 15:25'],
                ['l',                                  '14. 2. 2010'],
                ['ll',                                 '14. feb. 2010'],
                ['lll',                                '14. feb. 2010 15:25'],
                ['llll',                               'ned., 14. feb. 2010 15:25']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '1.', '1.');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '2.', '2.');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '3.', '3.');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '4.', '4.');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '5.', '5.');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '6.', '6.');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '7.', '7.');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '8.', '8.');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '9.', '9.');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '10.', '10.');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '11.', '11.');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '12.', '12.');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '13.', '13.');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '14.', '14.');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '15.', '15.');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '16.', '16.');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '17.', '17.');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '18.', '18.');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '19.', '19.');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '20.', '20.');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '21.', '21.');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '22.', '22.');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '23.', '23.');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '24.', '24.');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '25.', '25.');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '26.', '26.');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '27.', '27.');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '28.', '28.');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '29.', '29.');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '30.', '30.');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '31.', '31.');
    });

    test('format month', function (assert) {
        var expected = 'januar jan._februar feb._mart mar._april apr._maj maj._juni jun._juli jul._august aug._septembar sep._oktobar okt._novembar nov._decembar dec.'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'nedjelja ned. ne_ponedjeljak pon. po_utorak uto. ut_srijeda sri. sr_četvrtak čet. če_petak pet. pe_subota sub. su'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'par sekundi', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'jedna minuta',   '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'jedna minuta',   '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '2 minute',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '44 minuta',     '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'jedan sat',      '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'jedan sat',      '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '2 sata',        '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '5 sati',         '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '21 sati',        '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'dan',       '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'dan',       '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '2 dana',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'dan',       '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '5 dana',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '25 dana',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'mjesec',     '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'mjesec',     '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  'mjesec',     '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '2 mjeseca',     '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '2 mjeseca',     '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '3 mjeseca',     '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'mjesec',     '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '5 mjeseci',    '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'godinu',     '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '2 godine',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'godinu',     '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '5 godina',        '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'za par sekundi',  'prefix');
        assert.equal(moment(0).from(30000), 'prije par sekundi', 'prefix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'prije par sekundi',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'za par sekundi', 'in a few seconds');
        assert.equal(moment().add({d: 5}).fromNow(), 'za 5 dana', 'in 5 days');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                   'danas u 12:00',  'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),      'danas u 12:25',  'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),       'danas u 13:00',  'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),       'sutra u 12:00',  'tomorrow at the same time');
        assert.equal(moment(a).subtract({h: 1}).calendar(),  'danas u 11:00',  'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),  'jučer u 12:00',  'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;

        function makeFormat(d) {
            switch (d.day()) {
            case 0:
                return '[u] [nedjelju] [u] LT';
            case 3:
                return '[u] [srijedu] [u] LT';
            case 6:
                return '[u] [subotu] [u] LT';
            case 1:
            case 2:
            case 4:
            case 5:
                return '[u] dddd [u] LT';
            }
        }

        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;

        function makeFormat(d) {
            switch (d.day()) {
            case 0:
            case 3:
                return '[prošlu] dddd [u] LT';
            case 6:
                return '[prošle] [subote] [u] LT';
            case 1:
            case 2:
            case 4:
            case 5:
                return '[prošli] dddd [u] LT';
            }
        }

        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format(makeFormat(m)),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
    });

    test('weeks year starting sunday formatted', function (assert) {
        assert.equal(moment([2011, 11, 26]).format('w ww wo'), '1 01 1.', 'Dec 26 2011 should be week 1');
        assert.equal(moment([2012,  0,  1]).format('w ww wo'), '1 01 1.', 'Jan  1 2012 should be week 1');
        assert.equal(moment([2012,  0,  2]).format('w ww wo'), '2 02 2.', 'Jan  2 2012 should be week 2');
        assert.equal(moment([2012,  0,  8]).format('w ww wo'), '2 02 2.', 'Jan  8 2012 should be week 2');
        assert.equal(moment([2012,  0,  9]).format('w ww wo'), '3 03 3.', 'Jan  9 2012 should be week 3');
    });

}));

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../../moment')) :
   typeof define === 'function' && define.amd ? define(['../../moment'], factory) :
   factory(global.moment)
}(this, function (moment) { 'use strict';

    function each(array, callback) {
        var i;
        for (i = 0; i < array.length; i++) {
            callback(array[i], i, array);
        }
    }

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        } else {
            // IE8
            var res = [], i;
            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    res.push(i);
                }
            }
            return res;
        }
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function defineCommonLocaleTests(locale, options) {
        test('lenient ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing ' + i + ' date check');
            }
        });

        test('lenient ordinal parsing of number', function (assert) {
            var i, testMoment;
            for (i = 1; i <= 31; ++i) {
                testMoment = moment('2014 01 ' + i, 'YYYY MM Do');
                assert.equal(testMoment.year(), 2014,
                        'lenient ordinal parsing of number ' + i + ' year check');
                assert.equal(testMoment.month(), 0,
                        'lenient ordinal parsing of number ' + i + ' month check');
                assert.equal(testMoment.date(), i,
                        'lenient ordinal parsing of number ' + i + ' date check');
            }
        });

        test('strict ordinal parsing', function (assert) {
            var i, ordinalStr, testMoment;
            for (i = 1; i <= 31; ++i) {
                ordinalStr = moment([2014, 0, i]).format('YYYY MM Do');
                testMoment = moment(ordinalStr, 'YYYY MM Do', true);
                assert.ok(testMoment.isValid(), 'strict ordinal parsing ' + i);
            }
        });

        test('meridiem invariant', function (assert) {
            var h, m, t1, t2;
            for (h = 0; h < 24; ++h) {
                for (m = 0; m < 60; m += 15) {
                    t1 = moment.utc([2000, 0, 1, h, m]);
                    t2 = moment.utc(t1.format('A h:mm'), 'A h:mm');
                    assert.equal(t2.format('HH:mm'), t1.format('HH:mm'),
                            'meridiem at ' + t1.format('HH:mm'));
                }
            }
        });

        test('date format correctness', function (assert) {
            var data, tokens;
            data = moment.localeData()._longDateFormat;
            tokens = objectKeys(data);
            each(tokens, function (srchToken) {
                // Check each format string to make sure it does not contain any
                // tokens that need to be expanded.
                each(tokens, function (baseToken) {
                    // strip escaped sequences
                    var format = data[baseToken].replace(/(\[[^\]]*\])/g, '');
                    assert.equal(false, !!~format.indexOf(srchToken),
                            'contains ' + srchToken + ' in ' + baseToken);
                });
            });
        });

        test('month parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr') {
                // I can't fix it :(
                expect(0);
                return;
            }
            function tester(format) {
                var r;
                r = moment(m.format(format), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.month(), m.month(), 'month ' + i + ' fmt ' + format + ' lower strict');
            }

            for (i = 0; i < 12; ++i) {
                m = moment([2015, i, 15, 18]);
                tester('MMM');
                tester('MMM.');
                tester('MMMM');
                tester('MMMM.');
            }
        });

        test('weekday parsing correctness', function (assert) {
            var i, m;

            if (locale === 'tr' || locale === 'az') {
                // There is a lower-case letter (ı), that converted to upper then
                // lower changes to i
                expect(0);
                return;
            }
            function tester(format) {
                var r, baseMsg = 'weekday ' + m.weekday() + ' fmt ' + format;
                r = moment(m.format(format), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg);
                r = moment(m.format(format).toLocaleUpperCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper');
                r = moment(m.format(format).toLocaleLowerCase(), format);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower');

                r = moment(m.format(format), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' strict');
                r = moment(m.format(format).toLocaleUpperCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' upper strict');
                r = moment(m.format(format).toLocaleLowerCase(), format, true);
                assert.equal(r.weekday(), m.weekday(), baseMsg + ' lower strict');
            }

            for (i = 0; i < 7; ++i) {
                m = moment.utc([2015, i, 15, 18]);
                tester('dd');
                tester('ddd');
                tester('dddd');
            }
        });
    }

    function setupDeprecationHandler(test, moment, scope) {
        test._expectedDeprecations = null;
        test._observedDeprecations = null;
        test._oldSupress = moment.suppressDeprecationWarnings;
        moment.suppressDeprecationWarnings = true;
        test.expectedDeprecations = function () {
            test._expectedDeprecations = arguments;
            test._observedDeprecations = [];
        };
        moment.deprecationHandler = function (name, msg) {
            var deprecationId = matchedDeprecation(name, msg, test._expectedDeprecations);
            if (deprecationId === -1) {
                throw new Error('Unexpected deprecation thrown name=' +
                        name + ' msg=' + msg);
            }
            test._observedDeprecations[deprecationId] = 1;
        };
    }

    function teardownDeprecationHandler(test, moment, scope) {
        moment.suppressDeprecationWarnings = test._oldSupress;

        if (test._expectedDeprecations != null) {
            var missedDeprecations = [];
            each(test._expectedDeprecations, function (deprecationPattern, id) {
                if (test._observedDeprecations[id] !== 1) {
                    missedDeprecations.push(deprecationPattern);
                }
            });
            if (missedDeprecations.length !== 0) {
                throw new Error('Expected deprecation warnings did not happen: ' +
                        missedDeprecations.join(' '));
            }
        }
    }

    function matchedDeprecation(name, msg, deprecations) {
        if (deprecations == null) {
            return -1;
        }
        for (var i = 0; i < deprecations.length; ++i) {
            if (name != null && name === deprecations[i]) {
                return i;
            }
            if (msg != null && msg.substring(0, deprecations[i].length) === deprecations[i]) {
                return i;
            }
        }
        return -1;
    }

    /*global QUnit:false*/

    var test = QUnit.test;

    var expect = QUnit.expect;

    function module (name, lifecycle) {
        QUnit.module(name, {
            setup : function () {
                moment.locale('en');
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                teardownDeprecationHandler(test, moment, 'core');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
    }

    function localeModule (name, lifecycle) {
        QUnit.module('locale:' + name, {
            setup : function () {
                moment.locale(name);
                moment.createFromInputFallback = function (config) {
                    throw new Error('input not handled by moment: ' + config._i);
                };
                setupDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.setup) {
                    lifecycle.setup();
                }
            },
            teardown : function () {
                moment.locale('en');
                teardownDeprecationHandler(test, moment, 'locale');
                if (lifecycle && lifecycle.teardown) {
                    lifecycle.teardown();
                }
            }
        });
        defineCommonLocaleTests(name, -1, -1);
    }

    localeModule('ca');

    test('parse', function (assert) {
        var tests = 'gener gen._febrer febr._març mar._abril abr._maig mai._juny jun._juliol jul._agost ag._setembre set._octubre oct._novembre nov._desembre des.'.split('_'), i;
        function equalTest(input, mmm, i) {
            assert.equal(moment(input, mmm).month(), i, input + ' should be month ' + (i + 1));
        }
        for (i = 0; i < 12; i++) {
            tests[i] = tests[i].split(' ');
            equalTest(tests[i][0], 'MMM', i);
            equalTest(tests[i][1], 'MMM', i);
            equalTest(tests[i][0], 'MMMM', i);
            equalTest(tests[i][1], 'MMMM', i);
            equalTest(tests[i][0].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleLowerCase(), 'MMMM', i);
            equalTest(tests[i][0].toLocaleUpperCase(), 'MMMM', i);
            equalTest(tests[i][1].toLocaleUpperCase(), 'MMMM', i);
        }
    });

    test('format', function (assert) {
        var a = [
                ['dddd, Do MMMM YYYY, h:mm:ss a',      'diumenge, 14è febrer 2010, 3:25:50 pm'],
                ['ddd, hA',                            'dg., 3PM'],
                ['M Mo MM MMMM MMM',                   '2 2n 02 febrer febr.'],
                ['YYYY YY',                            '2010 10'],
                ['D Do DD',                            '14 14è 14'],
                ['d do dddd ddd dd',                   '0 0è diumenge dg. Dg'],
                ['DDD DDDo DDDD',                      '45 45è 045'],
                ['w wo ww',                            '6 6a 06'],
                ['h hh',                               '3 03'],
                ['H HH',                               '15 15'],
                ['m mm',                               '25 25'],
                ['s ss',                               '50 50'],
                ['a A',                                'pm PM'],
                ['[the] DDDo [day of the year]',       'the 45è day of the year'],
                ['LTS',                                '15:25:50'],
                ['L',                                  '14/02/2010'],
                ['LL',                                 '14 febrer 2010'],
                ['LLL',                                '14 febrer 2010 15:25'],
                ['LLLL',                               'diumenge 14 febrer 2010 15:25'],
                ['l',                                  '14/2/2010'],
                ['ll',                                 '14 febr. 2010'],
                ['lll',                                '14 febr. 2010 15:25'],
                ['llll',                               'dg. 14 febr. 2010 15:25']
            ],
            b = moment(new Date(2010, 1, 14, 15, 25, 50, 125)),
            i;
        for (i = 0; i < a.length; i++) {
            assert.equal(b.format(a[i][0]), a[i][1], a[i][0] + ' ---> ' + a[i][1]);
        }
    });

    test('format ordinal', function (assert) {
        assert.equal(moment([2011, 0, 1]).format('DDDo'), '1r', '1r');
        assert.equal(moment([2011, 0, 2]).format('DDDo'), '2n', '2n');
        assert.equal(moment([2011, 0, 3]).format('DDDo'), '3r', '3r');
        assert.equal(moment([2011, 0, 4]).format('DDDo'), '4t', '4t');
        assert.equal(moment([2011, 0, 5]).format('DDDo'), '5è', '5è');
        assert.equal(moment([2011, 0, 6]).format('DDDo'), '6è', '6è');
        assert.equal(moment([2011, 0, 7]).format('DDDo'), '7è', '7è');
        assert.equal(moment([2011, 0, 8]).format('DDDo'), '8è', '8è');
        assert.equal(moment([2011, 0, 9]).format('DDDo'), '9è', '9è');
        assert.equal(moment([2011, 0, 10]).format('DDDo'), '10è', '10è');

        assert.equal(moment([2011, 0, 11]).format('DDDo'), '11è', '11è');
        assert.equal(moment([2011, 0, 12]).format('DDDo'), '12è', '12è');
        assert.equal(moment([2011, 0, 13]).format('DDDo'), '13è', '13è');
        assert.equal(moment([2011, 0, 14]).format('DDDo'), '14è', '14è');
        assert.equal(moment([2011, 0, 15]).format('DDDo'), '15è', '15è');
        assert.equal(moment([2011, 0, 16]).format('DDDo'), '16è', '16è');
        assert.equal(moment([2011, 0, 17]).format('DDDo'), '17è', '17è');
        assert.equal(moment([2011, 0, 18]).format('DDDo'), '18è', '18è');
        assert.equal(moment([2011, 0, 19]).format('DDDo'), '19è', '19è');
        assert.equal(moment([2011, 0, 20]).format('DDDo'), '20è', '20è');

        assert.equal(moment([2011, 0, 21]).format('DDDo'), '21è', '21è');
        assert.equal(moment([2011, 0, 22]).format('DDDo'), '22è', '22è');
        assert.equal(moment([2011, 0, 23]).format('DDDo'), '23è', '23è');
        assert.equal(moment([2011, 0, 24]).format('DDDo'), '24è', '24è');
        assert.equal(moment([2011, 0, 25]).format('DDDo'), '25è', '25è');
        assert.equal(moment([2011, 0, 26]).format('DDDo'), '26è', '26è');
        assert.equal(moment([2011, 0, 27]).format('DDDo'), '27è', '27è');
        assert.equal(moment([2011, 0, 28]).format('DDDo'), '28è', '28è');
        assert.equal(moment([2011, 0, 29]).format('DDDo'), '29è', '29è');
        assert.equal(moment([2011, 0, 30]).format('DDDo'), '30è', '30è');

        assert.equal(moment([2011, 0, 31]).format('DDDo'), '31è', '31è');
    });

    test('format month', function (assert) {
        var expected = 'gener gen._febrer febr._març mar._abril abr._maig mai._juny jun._juliol jul._agost ag._setembre set._octubre oct._novembre nov._desembre des.'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
        }
    });

    test('format week', function (assert) {
        var expected = 'diumenge dg. Dg_dilluns dl. Dl_dimarts dt. Dt_dimecres dc. Dc_dijous dj. Dj_divendres dv. Dv_dissabte ds. Ds'.split('_'), i;
        for (i = 0; i < expected.length; i++) {
            assert.equal(moment([2011, 0, 2 + i]).format('dddd ddd dd'), expected[i], expected[i]);
        }
    });

    test('from', function (assert) {
        var start = moment([2007, 1, 28]);
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 44}), true),  'uns segons', '44 seconds = a few seconds');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 45}), true),  'un minut',      '45 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 89}), true),  'un minut',      '89 seconds = a minute');
        assert.equal(start.from(moment([2007, 1, 28]).add({s: 90}), true),  '2 minuts',     '90 seconds = 2 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 44}), true),  '44 minuts',    '44 minutes = 44 minutes');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 45}), true),  'una hora',       '45 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 89}), true),  'una hora',       '89 minutes = an hour');
        assert.equal(start.from(moment([2007, 1, 28]).add({m: 90}), true),  '2 hores',       '90 minutes = 2 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 5}), true),   '5 hores',       '5 hours = 5 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 21}), true),  '21 hores',      '21 hours = 21 hours');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 22}), true),  'un dia',         '22 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 35}), true),  'un dia',         '35 hours = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({h: 36}), true),  '2 dies',        '36 hours = 2 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 1}), true),   'un dia',         '1 day = a day');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 5}), true),   '5 dies',        '5 days = 5 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 25}), true),  '25 dies',       '25 days = 25 days');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 26}), true),  'un mes',       '26 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 30}), true),  'un mes',       '30 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 43}), true),  'un mes',       '43 days = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 46}), true),  '2 mesos',      '46 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 74}), true),  '2 mesos',      '75 days = 2 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 76}), true),  '3 mesos',      '76 days = 3 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 1}), true),   'un mes',       '1 month = a month');
        assert.equal(start.from(moment([2007, 1, 28]).add({M: 5}), true),   '5 mesos',      '5 months = 5 months');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 345}), true), 'un any',        '345 days = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({d: 548}), true), '2 anys',       '548 days = 2 years');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 1}), true),   'un any',        '1 year = a year');
        assert.equal(start.from(moment([2007, 1, 28]).add({y: 5}), true),   '5 anys',       '5 years = 5 years');
    });

    test('suffix', function (assert) {
        assert.equal(moment(30000).from(0), 'en uns segons',  'prefix');
        assert.equal(moment(0).from(30000), 'fa uns segons', 'suffix');
    });

    test('now from now', function (assert) {
        assert.equal(moment().fromNow(), 'fa uns segons',  'now from now should display as in the past');
    });

    test('fromNow', function (assert) {
        assert.equal(moment().add({s: 30}).fromNow(), 'en uns segons', 'en uns segons');
        assert.equal(moment().add({d: 5}).fromNow(), 'en 5 dies', 'en 5 dies');
    });

    test('calendar day', function (assert) {
        var a = moment().hours(12).minutes(0).seconds(0);

        assert.equal(moment(a).calendar(),                       'avui a les 12:00',     'today at the same time');
        assert.equal(moment(a).add({m: 25}).calendar(),          'avui a les 12:25',     'Now plus 25 min');
        assert.equal(moment(a).add({h: 1}).calendar(),           'avui a les 13:00',     'Now plus 1 hour');
        assert.equal(moment(a).add({d: 1}).calendar(),           'demà a les 12:00',     'tomorrow at the same time');
        assert.equal(moment(a).add({d: 1, h : -1}).calendar(),   'demà a les 11:00',     'tomorrow minus 1 hour');
        assert.equal(moment(a).subtract({h: 1}).calendar(),      'avui a les 11:00',     'Now minus 1 hour');
        assert.equal(moment(a).subtract({d: 1}).calendar(),      'ahir a les 12:00',     'yesterday at the same time');
    });

    test('calendar next week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().add({d: i});
            assert.equal(m.calendar(),       m.format('dddd [a ' + ((m.hours() !== 1) ? 'les' : 'la') + '] LT'),  'Today + ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('dddd [a ' + ((m.hours() !== 1) ? 'les' : 'la') + '] LT'),  'Today + ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('dddd [a ' + ((m.hours() !== 1) ? 'les' : 'la') + '] LT'),  'Today + ' + i + ' days end of day');
        }
    });

    test('calendar last week', function (assert) {
        var i, m;
        for (i = 2; i < 7; i++) {
            m = moment().subtract({d: i});
            assert.equal(m.calendar(),       m.format('[el] dddd [passat a ' + ((m.hours() !== 1) ? 'les' : 'la') + '] LT'),  'Today - ' + i + ' days current time');
            m.hours(0).minutes(0).seconds(0).milliseconds(0);
            assert.equal(m.calendar(),       m.format('[el] dddd [passat a ' + ((m.hours() !== 1) ? 'les' : 'la') + '] LT'),  'Today - ' + i + ' days beginning of day');
            m.hours(23).minutes(59).seconds(59).milliseconds(999);
            assert.equal(m.calendar(),       m.format('[el] dddd [passat a ' + ((m.hours() !== 1) ? 'les' : 'la') + '] LT'),  'Today - ' + i + ' days end of day');
        }
    });

    test('calendar all else', function (assert) {
        var weeksAgo = moment().subtract({w: 1}),
            weeksFromNow = moment().add({w: 1});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
        assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

        weeksAgo = moment().subtract({w: 2});
        weeksFromNow = moment().add({w: 2});

        assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
        assert.equal(weeksFromNow.calenda