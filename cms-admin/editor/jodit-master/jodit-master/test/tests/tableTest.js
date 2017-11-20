describe('Tables Jodit Editor Tests', function() {
    appendTestArea('table_editor', true);
    describe('Methods', function() {
        it('After init container must has one element .jodit_table_resizer', function() {
            var editor = new Jodit('#table_editor');
            expect(editor.editor.querySelector('.jodit_table_resizer')).to.equal(null);
            editor.selection.insertNode(Jodit.modules.Dom.create('table', '', editor.editorDocument));
            editor.selection.insertNode(Jodit.modules.Dom.create('table', '', editor.editorDocument));
            expect(editor.container.querySelectorAll('.jodit_table_resizer').length).to.equal(1);
        });
        it('Process wrong tabel', function() {
            var editor = new Jodit('#table_editor');
            editor.setEditorValue('<table>' +
                    '<tr>' +
                        '<td data-jodit-selected-cell="1">1</td>' +
                        '<td data-jodit-selected-cell="1">2</td>' +
                        '<td rowspan="2">3</td>' +
                    '</tr>' +
                    '<tr><td>4</td></tr>' +
                '</table>')

            // var table = new Jodit.modules.Table(editor);
            Jodit.modules.Table.mergeSelected(editor.editor.firstChild);

            expect(editor.container.querySelectorAll('.jodit_table_resizer').length).to.equal(1);
        });
        it('Method getRowsCount should return TR count', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                [1,2,3,4].map(function () {
                    return '<tr>' +
                        '<td>1</td>' +
                        '<td>2</td>' +
                        '</tr>';
                }).join('') +
                '</table>');

            // var table = new Jodit.modules.Table(editor);
            expect(Jodit.modules.Table.getRowsCount(editor.editor.firstChild)).to.equal(4);
        });
        it('Method getColumnsCount should return maximum of TH or TD in one row in table', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                    '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                    '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                    '<tr><td colspan="2">12</td><td>3</td></tr>' +
                    '<tr><td colspan="3">123</td></tr>' +
                    '<tr><td colspan="3">123</td><td>4</td></tr>' + // 4 cells - wrong table but will suit
                '</table>');

            expect(Jodit.modules.Table.getColumnsCount(editor.editor.firstChild)).to.equal(4);
        });
        it('Method appendRow should append one row in the end of table', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                '</table>');

            Jodit.modules.Table.appendRow(editor.editor.firstChild);

            expect(editor.getEditorValue()).to.equal('<table><tbody><tr><td>1</td><td>2</td><td>3</td></tr><tr><td></td><td></td><td></td></tr></tbody></table>');
        });
        it('Method appendRow with second argument should append one row after row', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                '<tr><td>2</td><td>3</td><td>4</td></tr>' +
                '</table>');

            Jodit.modules.Table.appendRow(editor.editor.firstChild, editor.editor.firstChild.querySelector('tr'));

            expect(editor.getEditorValue()).to.equal('<table><tbody><tr><td>1</td><td>2</td><td>3</td></tr><tr><td></td><td></td><td></td></tr><tr><td>2</td><td>3</td><td>4</td></tr></tbody></table>');
        });
        it('Method appendRow with second=TR  and third=false arguments should append and one row before row', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                '<tr><td>2</td><td>3</td><td>4</td></tr>' +
                '</table>');


            Jodit.modules.Table.appendRow(editor.editor.firstChild, editor.editor.firstChild.querySelector('tr'), false);

            expect(editor.getEditorValue()).to.equal('<table><tbody><tr><td></td><td></td><td></td></tr><tr><td>1</td><td>2</td><td>3</td></tr><tr><td>2</td><td>3</td><td>4</td></tr></tbody></table>');
        });
        it('Method appendColumn should append column in the end', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr><td>1</td><td>2</td></tr>' +
                '<tr><td colspan="2">3</td></tr>' +
                '</table>');

            Jodit.modules.Table.appendColumn(editor.editor.firstChild);

            expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                '<tbody>' +
                    '<tr><td>1</td><td>2</td><td></td></tr>' +
                    '<tr><td colspan="2">3</td><td></td></tr>' +
                '</tbody>' +
            '</table>');
        });
        it('Method appendColumn with second argument should append column after that column', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr><td>1</td><td>2</td></tr>' +
                '<tr><td colspan="2">3</td></tr>' +
                '</table>');

            Jodit.modules.Table.appendColumn(editor.editor.firstChild, 0);

            expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                '<tbody>' +
                '<tr><td>1</td><td></td><td>2</td></tr>' +
                '<tr><td colspan="3">3</td></tr>' +
                '</tbody>' +
                '</table>');
        });
        it('Method appendColumn with second argument and third = false should append column before that column', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr><td>1</td><td>2</td></tr>' +
                '<tr><td colspan="2">3</td></tr>' +
                '</table>');

            Jodit.modules.Table.appendColumn(editor.editor.firstChild, 1, false);

            expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                '<tbody>' +
                '<tr><td>1</td><td></td><td>2</td></tr>' +
                '<tr><td colspan="3">3</td></tr>' +
                '</tbody>' +
                '</table>');
        });
        it('Remove row should delete TR from table', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                '<tr><td rowspan="2">4</td><td>5</td><td>6</td></tr>' +
                '<tr><td>7</td><td>8</td></tr>' +
                '</table>');

            simulateEvent('mousedown', Jodit.KEY_TAB, editor.editor.querySelectorAll('td')[4]);

            Jodit.modules.Table.removeRow(editor.editor.firstChild, 1);

            expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                '<tbody>' +
                '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                '<tr><td>4</td><td>7</td><td>8</td></tr>' +
                '</tbody>' +
                '</table>');
        });
        describe('Method merge selected cells', function() {
            it('Simple should merge all selected cells into one ', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td data-jodit-selected-cell="1">1</td><td data-jodit-selected-cell="1">2</td></tr>' +
                    '<tr><td data-jodit-selected-cell="1">3</td><td data-jodit-selected-cell="1">4</td></tr>' +
                    '<tr><td>5</td><td>6</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.mergeSelected(editor.editor.firstChild);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td colspan="2" data-jodit-selected-cell="1">1<br>2<br>3<br>4</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>5</td>' +
                    '<td>6</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>'
                );
            });
            it('With colspan and rowspan into one ', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td colspan="2" data-jodit-selected-cell="1">1</td></tr>' +
                    '<tr><td data-jodit-selected-cell="1">3</td><td data-jodit-selected-cell="1">4</td></tr>' +
                    '<tr><td rowspan="2" data-jodit-selected-cell="1">5</td><td data-jodit-selected-cell="1">6</td></tr>' +
                    '<tr><td data-jodit-selected-cell="1">7</td></tr>' +
                    '<tr><td>8</td><td>9</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.mergeSelected(editor.editor.firstChild);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table>' +
                        '<tbody>' +
                            '<tr>' +
                                '<td colspan="2" data-jodit-selected-cell="1">' +
                                    '1<br>3<br>4<br>5<br>6<br>7' +
                                '</td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td>8</td>' +
                                '<td>9</td>' +
                            '</tr>' +
                        '</tbody>' +
                    '</table>'
                );
            });
            it('A few cells with colspan and rowspan', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue(
                    '<table style="width: 100%;">' +
                    '<tbody>' +
                    '<tr><td data-jodit-selected-cell="1" colspan="3">0,0<br>0,1<br>0,2<br></td><td>0,3</td></tr>' +
                    '<tr><td data-jodit-selected-cell="1" rowspan="3">1,0<br>2,0<br>3,0<br></td><td data-jodit-selected-cell="1">1,1</td><td data-jodit-selected-cell="1">1,2</td><td>1,3</td></tr>' +
                    '<tr><td data-jodit-selected-cell="1">2,1</td><td data-jodit-selected-cell="1">2,2</td><td>2,3</td></tr>' +
                    '<tr><td data-jodit-selected-cell="1">3,1</td><td data-jodit-selected-cell="1">3,2</td><td>3,3</td></tr>' +
                    '</tbody></table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.mergeSelected(editor.editor.firstChild);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table style="width:100%">' +
                        '<tbody>' +
                            '<tr>' +
                                '<td data-jodit-selected-cell="1" rowspan="4">' +
                                    '0,0<br>0,1<br>0,2<br><br>' +
                                    '1,0<br>2,0<br>3,0<br><br>' +
                                    '1,1<br>' +
                                    '1,2<br>' +
                                    '2,1<br>' +
                                    '2,2<br>' +
                                    '3,1<br>' +
                                    '3,2' +
                                '</td>' +
                                '<td>0,3</td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td>1,3</td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td>2,3</td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td>3,3</td>' +
                            '</tr>' +
                        '</tbody>' +
                    '</table>'
                );
            });
            it('Merge cells in center', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue(
                    '<table style="width: 100%;">' +
                    '<tbody>' +
                    '<tr><td colspan="3" class="">0,0<br>0,1<br>0,2<br></td><td>0,3</td></tr>' +
                    '<tr>' +
                        '<td rowspan="3" class="">1,0<br>2,0<br>3,0<br></td>' +
                        '<td data-jodit-selected-cell="1">1,1</td><td data-jodit-selected-cell="1">1,2</td>' +
                        '<td data-jodit-selected-cell="1">1,3</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td data-jodit-selected-cell="1">2,1</td>' +
                        '<td data-jodit-selected-cell="1">2,2</td>' +
                        '<td data-jodit-selected-cell="1">2,3</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td class="">3,1</td>' +
                        '<td class="">3,2</td>' +
                        '<td>3,3</td></tr>' +
                    '</tbody>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.mergeSelected(editor.editor.firstChild);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table style="width:100%">' +
                        '<tbody>' +
                            '<tr>' +
                                '<td colspan="3">0,0<br>0,1<br>0,2<br></td><td>0,3</td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td rowspan="2">1,0<br>2,0<br>3,0<br></td>' +
                                '<td colspan="3" data-jodit-selected-cell="1">1,1<br>1,2<br>1,3<br>2,1<br>2,2<br>2,3</td>' +
                            '</tr>' +
                            '<tr>' +
                                '<td>3,1</td><td>3,2</td><td>3,3</td>' +
                            '</tr>' +
                        '</tbody>' +
                    '</table>'
                );
            });
            it('Normalize merged cells', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue(
                    '<table>' +
                        '<tbody>' +
                            '<tr>' +
                                '<td colspan="3" data-jodit-selected-cell="1" rowspan="4">1</td>' +
                                '<td data-jodit-selected-cell="1" rowspan="4">2</td>' +
                            '</tr>' +
                            '<tr></tr>' +
                            '<tr></tr>' +
                            '<tr></tr>' +
                        '</tbody>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.mergeSelected(editor.editor.firstChild);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table>' +
                        '<tbody>' +
                            '<tr>' +
                                '<td data-jodit-selected-cell="1">1<br>2</td>' +
                            '</tr>' +
                        '</tbody>' +
                    '</table>'
                );
            });
        })
        describe('Split selected cells', function() {
            it('Split cell by Horizontal', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue(
                    '<table>' +
                    '<tbody>' +
                        '<tr><td data-jodit-selected-cell="1">0,0</td></tr>' +
                        '<tr><td>1,0</td></tr>' +
                    '</tbody>' +
                    '</table>'
                );

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.splitHorizontal(editor.editor.firstChild);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table>' +
                        '<tbody>' +
                            '<tr><td>0,0</td></tr>' +
                            '<tr><td><br></td></tr>' +
                            '<tr><td>1,0</td></tr>' +
                        '</tbody>' +
                    '</table>'
                );
            });
            it('Split cell with rowspan by horizontal ', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue(
                    '<table>' +
                        '<tbody>' +
                            '<tr><td>0,0</td><td>0,1</td><td>0,2</td></tr>' +
                            '<tr>' +
                                '<td rowspan="2" data-jodit-selected-cell="1">1,0</td>' +
                                '<td>1,1</td>' +
                                '<td rowspan="2">1,2</td>' +
                            '</tr>' +
                            '<tr><td><br></td></tr>' +
                            '<tr><td>2,0</td><td>2,1</td><td>2,2</td></tr>' +
                        '</tbody>' +
                    '</table>'
                );

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.splitHorizontal(editor.editor.firstChild);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table>' +
                        '<tbody>' +
                            '<tr><td>0,0</td><td>0,1</td><td>0,2</td></tr>' +
                            '<tr>' +
                                '<td>1,0</td>' +
                                '<td>1,1</td>' +
                                '<td rowspan="2">1,2</td>' +
                            '</tr>' +
                            '<tr><td><br></td><td><br></td></tr>' +
                            '<tr><td>2,0</td><td>2,1</td><td>2,2</td></tr>' +
                        '</tbody>' +
                    '</table>'
                );
            });
            it('Split cell with rowspan by horizontal 2', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue(
                    '<table>' +
                    '<tbody>' +
                    '<tr><td>0,0</td><td>0,1</td><td>0,2</td></tr>' +
                    '<tr>' +
                    '<td rowspan="2">1,0</td>' +
                    '<td rowspan="2" data-jodit-selected-cell="1">1,1</td>' +
                    '<td>1,2</td>' +
                    '</tr>' +
                    '<tr><td><br></td></tr>' +
                    '<tr><td>2,0</td><td>2,1</td><td>2,2</td></tr>' +
                    '</tbody>' +
                    '</table>'
                );

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.splitHorizontal(editor.editor.firstChild);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table>' +
                    '<tbody>' +
                    '<tr><td>0,0</td><td>0,1</td><td>0,2</td></tr>' +
                    '<tr>' +
                    '<td rowspan="2">1,0</td>' +
                    '<td>1,1</td>' +
                    '<td>1,2</td>' +
                    '</tr>' +
                    '<tr><td><br></td><td><br></td></tr>' +
                    '<tr><td>2,0</td><td>2,1</td><td>2,2</td></tr>' +
                    '</tbody>' +
                    '</table>'
                );
            });
            it('Split cell by vertical', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue(
                    '<table style="width: 300px;">' +
                        '<tbody>' +
                            '<tr><td style="width:100px" data-jodit-selected-cell="1">0,0</td><td>0,1</td></tr>' +
                            '<tr><td>1,0</td><td>1,1</td></tr>' +
                        '</tbody>' +
                    '</table>'
                );

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.splitVertical(editor.editor.firstChild);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table style="width:300px">' +
                        '<tbody>' +
                            '<tr><td style="width:16.66%">0,0</td><td style="width:16.66%"><br></td><td>0,1</td></tr>' +
                            '<tr><td colspan="2">1,0</td><td>1,1</td></tr>' +
                        '</tbody>' +
                    '</table>'
                );
            });
        })
    });
    describe('Work with tables', function() {
        it('Create table and insert into cell some text', function() {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('');

            var table = Jodit.modules.Dom.create('table', '', editor.editorDocument),
                tr = Jodit.modules.Dom.create('tr', '', editor.editorDocument),
                td = Jodit.modules.Dom.create('td', '', editor.editorDocument),
                td2 = Jodit.modules.Dom.create('td', '', editor.editorDocument);

            tr.appendChild(td);
            tr.appendChild(td2);
            table.appendChild(tr);

            editor.selection.insertNode(table, false);
            editor.selection.setCursorIn(table, false); // set cursor in last cell
            editor.selection.insertNode(Jodit.modules.Dom.create('text', 'ok', editor.editorDocument));

            expect(editor.getEditorValue()).to.equal('<table><tr><td></td><td>ok</td></tr></table>');
        });
        it('After insert table like html without tbody, it should be appear', function () {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                    '<tr>' +
                        '<td>1</td>' +
                        '<td>2</td>' +
                    '</tr>' +
                '</table>');

            expect(editor.getEditorValue()).to.equal('<table><tbody><tr><td>1</td><td>2</td></tr></tbody></table>');
        });
        it('After press Tab button cursor should be in next cell in table', function () {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr>' +
                '<td>1</td>' +
                '<td>2</td>' +
                '</tr>' +
                '</table>');

            editor.selection.setCursorIn(editor.editor.querySelector('td'));

            simulateEvent('keydown', Jodit.KEY_TAB, editor.editor);

            editor.selection.insertNode(Jodit.modules.Dom.create('text', 'test', editor.editorDocument), false);

            expect(editor.getEditorValue()).to.equal('<table><tbody><tr><td>1</td><td>test</td></tr></tbody></table>');
        })
        it('After press Tab + Shift buttons cursor should be in next cell in table', function () {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr>' +
                '<td>1</td>' +
                '<td>2</td>' +
                '</tr>' +
                '</table>');

            editor.selection.setCursorIn(editor.editor.querySelector('td').nextSibling);

            simulateEvent('keydown', Jodit.KEY_TAB, editor.editor, function (evnt) {
                evnt.shiftKey = true;
            });

            editor.selection.insertNode(Jodit.modules.Dom.create('text', 'test', editor.editorDocument), false);

            expect(editor.getEditorValue()).to.equal('<table><tbody><tr><td>test</td><td>2</td></tr></tbody></table>');
        })

        it('After press Right arrow not in the end of cell it should do nothing', function () {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr>' +
                '<td>1</td>' +
                '<td>2</td>' +
                '</tr>' +
                '</table>');

            editor.selection.setCursorIn(editor.editor.querySelector('td'), true); // set cursor before 1

            simulateEvent('keydown', Jodit.KEY_RIGHT, editor.editor); // not work but in real cursor move after 1

            editor.selection.insertNode(Jodit.modules.Dom.create('text', 'test',  editor.editorDocument), false);

            expect(editor.getEditorValue()).to.equal('<table><tbody><tr><td>test1</td><td>2</td></tr></tbody></table>');
        })
        it('After press Left arrow in the start of cell it should work like tab + shift', function () {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr>' +
                    '<td>1</td>' +
                    '<td>2</td>' +
                '</tr>' +
                '</table>');

            editor.selection.setCursorIn(editor.editor.querySelector('td').nextSibling, true); // set cursor before 1

            simulateEvent('keydown', Jodit.KEY_LEFT, editor.editor); // not work but in real cursor move after 1

            editor.selection.insertNode(Jodit.modules.Dom.create('text', 'test', editor.editorDocument), false);

            expect(editor.getEditorValue()).to.equal('<table><tbody>' +
                '<tr>' +
                  '<td>1test</td>' +
                  '<td>2</td>' +
                '</tr>' +
                '</tbody></table>');
        })
        it('After press Top arrow in the first cell\'s line cursor should move into top cell', function () {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr>' +
                    '<td>1</td>' +
                    '<td>2</td>' +
                '</tr>' +
                '<tr>' +
                    '<td>3</td>' +
                    '<td>4<br>5<br>6</td>' +
                '</tr>' +
                '</table>');

            editor.selection.setCursorAfter(editor.editor.querySelectorAll('td')[3].firstChild); // set cursor after 4

            simulateEvent('keydown', Jodit.KEY_TOP, editor.editor);

            editor.selection.insertNode(Jodit.modules.Dom.create('text', 'test', editor.editorDocument), false);

            expect(editor.getEditorValue()).to.equal('<table><tbody>' +
                '<tr>' +
                    '<td>1</td>' +
                    '<td>2test</td></tr>' +
                '<tr>' +
                    '<td>3</td>' +
                    '<td>' +
                        '4<br>' +
                        '5<br>' +
                        '6' +
                    '</td>' +
                '</tr>' +
                '</tbody></table>');
        })
        it('After press Bottom arrow in the first cell\'s line cursor should move into bottom cell', function () {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr>' +
                    '<td>1</td>' +
                    '<td>2<br>3</td>' +
                '</tr>' +
                '<tr>' +
                    '<td>4</td>' +
                    '<td>5</td>' +
                '</tr>' +
                '</table>');

            editor.selection.setCursorAfter(editor.editor.querySelectorAll('td')[1].lastChild); // set cursor after 3

            simulateEvent('keydown', Jodit.KEY_BOTTOM, editor.editor);

            editor.selection.insertNode(Jodit.modules.Dom.create('text', 'test', editor.editorDocument), false);

            expect(editor.getEditorValue()).to.equal('<table><tbody>' +
                '<tr>' +
                    '<td>1</td>' +
                    '<td>2<br>3</td>' +
                '</tr>' +
                '<tr>' +
                    '<td>4</td>' +
                    '<td>test5</td>' +
                '</tr>' +
                '</tbody></table>');
        })
        it('After press Tab in last table\'s cell in table should add new row and move into first cell form it', function () {
            var editor = new Jodit('#table_editor');

            editor.setEditorValue('<table>' +
                '<tr>' +
                    '<td>1</td>' +
                    '<td>2</td>' +
                '</tr>' +
                '</table>');

            editor.selection.setCursorAfter(editor.editor.querySelectorAll('td')[1].lastChild); // set cursor after 2

            simulateEvent('keydown', Jodit.KEY_TAB, editor.editor);

            editor.selection.insertNode(Jodit.modules.Dom.create('text', 'test', editor.editorDocument), false);

            expect(editor.getEditorValue()).to.equal('<table><tbody>' +
                '<tr>' +
                    '<td>1</td>' +
                    '<td>2</td>' +
                '</tr>' +
                '<tr>' +
                    '<td>test<br></td>' +
                    '<td></td>' +
                '</tr>' +
                '</tbody></table>');
        })
        describe('Remove row', function () {
            it('Remove simple row without rowspan should simple remove row', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td>1</td><td>2</td></tr>' +
                    '<tr><td>3</td><td>4</td></tr>' +
                    '</table>');

                var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeRow(editor.editor.firstChild, 0);

                expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                    '<tbody>' +
                        '<tr><td>3</td><td>4</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });
            it('Remove row which not consists td, because of in previous row was cell with rowspan should simple remove row and decrement rowspan', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td rowspan="2">1</td><td>2</td></tr>' +
                    '<tr><td>3</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeRow(editor.editor.firstChild, 1);

                expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                    '<tbody>' +
                    '<tr><td>1</td><td>2</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });
            it('Remove row which not consists td, because of in previous row was cell with rowspan and colspan should simple remove row and decrement rowspan once time', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td rowspan="3" colspan="2">1</td><td>2</td></tr>' +
                    '<tr><td>3</td></tr>' +
                    '<tr><td>4</td></tr>' +
                    '<tr><td>5</td><td>6</td><td>7</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeRow(editor.editor.firstChild, 1);

                expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                    '<tbody>' +
                        '<tr><td rowspan="2" colspan="2">1</td><td>2</td></tr>' +
                        '<tr><td>4</td></tr>' +
                        '<tr><td>5</td><td>6</td><td>7</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });
            it('Remove row which consists td with rowspan should simple remove row and decrement rowspan and move that cell into next row', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td rowspan="2">1</td><td>2</td></tr>' +
                    '<tr><td>3</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeRow(editor.editor.firstChild, 0);

                expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                    '<tbody>' +
                    '<tr><td>1</td><td>3</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });
            it('Remove row which consists td with rowspan and colspan should simple remove row and decrement rowspan and move that cell into next row', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td rowspan="2" colspan="2">1</td><td>2</td></tr>' +
                    '<tr><td>3</td></tr>' +
                    '<tr><td>4</td><td>5</td><td>6</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeRow(editor.editor.firstChild, 0);

                expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                    '<tbody>' +
                    '<tr><td colspan="2">1</td><td>3</td></tr>' +
                    '<tr><td>4</td><td>5</td><td>6</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });
            it('Remove row which consists last td with rowspan and colspan should simple remove row and decrement rowspan and move that cell into next row in last position', function () {

                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                    '<tr><td>4</td><td colspan="2" rowspan="2">5</td></tr>' +
                    '<tr><td>6</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeRow(editor.editor.firstChild, 1);

                expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                    '<tbody>' +
                    '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                    '<tr><td>6</td><td colspan="2">5</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });

        });
        describe('Remove column', function () {
            it('Remove simple column without colspan should simple remove all cells in column', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td>1</td><td>2</td></tr>' +
                    '<tr><td>3</td><td>4</td></tr>' +
                    '<tr><td>5</td><td>6</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeColumn(editor.editor.firstChild, 0);

                expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                    '<tbody>' +
                        '<tr><td>2</td></tr>' +
                        '<tr><td>4</td></tr>' +
                        '<tr><td>6</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });
            it('Remove column which consists td with colspan should remove all cells in column but that td should decrement colspan', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                        '<tr><td>1</td><td>2</td></tr>' +
                        '<tr><td colspan="2">3</td></tr>' +
                        '<tr><td>4</td><td>5</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeColumn(editor.editor.firstChild, 0);

                expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                    '<tbody>' +
                        '<tr><td>2</td></tr>' +
                        '<tr><td>3</td></tr>' +
                        '<tr><td>5</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });
            it('Remove column which not consists td with colspan should remove all cells in column but that td should decrement colspan too', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td>1</td><td>2</td></tr>' +
                    '<tr><td colspan="2">3</td></tr>' +
                    '<tr><td>4</td><td>5</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeColumn(editor.editor.firstChild, 1);

                expect(editor.getEditorValue().toLowerCase()).to.equal('<table>' +
                    '<tbody>' +
                    '<tr><td>1</td></tr>' +
                    '<tr><td>3</td></tr>' +
                    '<tr><td>4</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });
            it('Remove column part of that td (colspan and rowspan) in another column should remove all cells in column but that td should decrement colspan once time', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                        '<tr><td>1</td><td>2</td><td>3</td><td>4</td></tr>' +
                        '<tr><td>5</td><td colspan="3" rowspan="2">6</td></tr>' +
                        '<tr><td>7</td></tr>' +
                    '</table>');

                // var table = new Jodit.modules.Table(editor);
                Jodit.modules.Table.removeColumn(editor.editor.firstChild, 3);

                var result = editor.getEditorValue().toLowerCase();

                // in ie colspan and rowspan change places but it is not so important
                result = result.replace('rowspan', 'colspan');

                expect(result).to.equal('<table>' +
                    '<tbody>' +
                        '<tr><td>1</td><td>2</td><td>3</td></tr>' +
                        '<tr><td>5</td><td colspan="2" colspan="2">6</td></tr>' +
                        '<tr><td>7</td></tr>' +
                    '</tbody>' +
                    '</table>');
            });
        });
        describe('Select cells', function () {
            it('When we press mouse button over cell and move mouse to another cell, it should select all cells in bound', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td>1</td><td>2</td></tr>' +
                    '<tr><td>3</td><td>4</td></tr>' +
                    '<tr><td>5</td><td>6</td></tr>' +
                    '</table>');

                simulateEvent('mousedown', 1, editor.editor.querySelector('td'));
                simulateEvent('mousemove', 1, editor.editor.querySelectorAll('td')[3]);
                simulateEvent('mouseup', 1, editor.editor.querySelectorAll('td')[3]);

                expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal(
                    '<table>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td data-jodit-selected-cell="1">1</td>' +
                    '<td data-jodit-selected-cell="1">2</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td data-jodit-selected-cell="1">3</td>' +
                    '<td data-jodit-selected-cell="1">4</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>5</td>' +
                    '<td>6</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>'
                );
            });
            it('When we press mouse button over cell in subtable and move mouse to another cell, it should select all cells in bound in that table', function () {
                 var editor = new Jodit('#table_editor');

                 editor.setEditorValue('<table>' +
                 '<tr><td>1</td><td>2</td></tr>' +
                 '<tr>' +
                     '<td>3</td>' +
                     '<td class="test">' +
                         '<table>' +
                             '<tr><td>1</td><td>2</td></tr>' +
                             '<tr><td>3</td><td>4</td></tr>' +
                             '<tr><td>5</td><td>6</td></tr>' +
                        '</table>' +
                     '</td>' +
                 '</tr>' +
                 '<tr><td>5</td><td>6</td></tr>' +
                 '</table>');

                 //var table = new Jodit.modules.Table(editor);
                 //editor.selection.setCursorIn(editor.editor.querySelector('td'));

                 simulateEvent('mousedown', 1, editor.editor.querySelector('.test').querySelector('td'));
                 simulateEvent('mousemove', 1, editor.editor.querySelector('.test').querySelectorAll('td')[3]);

                 expect(sortAtrtibutes(editor.editor.innerHTML)).to.equal('<table><tbody><tr><td>1</td><td>2</td></tr><tr><td>3</td><td class="test"><table><tbody><tr><td data-jodit-selected-cell="1">1</td><td data-jodit-selected-cell="1">2</td></tr><tr><td data-jodit-selected-cell="1">3</td><td data-jodit-selected-cell="1">4</td></tr><tr><td>5</td><td>6</td></tr></tbody></table></td></tr><tr><td>5</td><td>6</td></tr></tbody></table>');
             });
            it('When we press mouse button over cell and move mouse to another cell, it should select all cells in bound even if between be colspan and rowspan', function () {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue(
                    '<table style="width: 100%;">' +
                        '<tbody>' +
                            '<tr><td colspan="3">0,0<br>0,1<br>0,2<br></td><td>0,3</td></tr>' +
                            '<tr><td rowspan="3">1,0<br>2,0<br>3,0<br></td><td>1,1</td><td>1,2</td><td>1,3</td></tr>' +
                            '<tr><td>2,1</td><td>2,2</td><td>2,3</td></tr>' +
                            '<tr><td>3,1</td><td>3,2</td><td>3,3</td></tr>' +
                        '</tbody>' +
                    '</table>'
                );

                //var table = new Jodit.modules.Table(editor);
                //editor.selection.setCursorIn(editor.editor.querySelector('td'));

                simulateEvent('mousedown', 1, editor.editor.querySelectorAll('td')[0]);
                simulateEvent('mousemove', 1, editor.editor.querySelectorAll('td')[7]);

                expect(
                    sortAtrtibutes(editor.editor.innerHTML) // ie change position between colspan and class
                ).to.equal(
                    '<table style="width:100%"><tbody><tr><td colspan="3" data-jodit-selected-cell="1">0,0<br>0,1<br>0,2<br></td><td>0,3</td></tr><tr><td data-jodit-selected-cell="1" rowspan="3">1,0<br>2,0<br>3,0<br></td><td data-jodit-selected-cell="1">1,1</td><td data-jodit-selected-cell="1">1,2</td><td>1,3</td></tr><tr><td data-jodit-selected-cell="1">2,1</td><td data-jodit-selected-cell="1">2,2</td><td>2,3</td></tr><tr><td data-jodit-selected-cell="1">3,1</td><td data-jodit-selected-cell="1">3,2</td><td>3,3</td></tr></tbody></table>'
                );
            });
        });
        describe('Resize column', function () {
            it('When move mouse over edge of cell jodit should show resizer element', function (done) {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table>' +
                    '<tr><td>1</td><td>2</td></tr>' +
                    '</table><p>3</p>');

                simulateEvent('mousemove', 1, editor.editor.querySelectorAll('td')[1], function (options) {
                    var box = editor.editor.querySelectorAll('td')[1].getBoundingClientRect();
                    options.clientX = box.left;
                    options.offsetX = 0;
                    options.pageX = 0;
                    options.pageY = 0;
                });

                expect(editor.container.querySelector('.jodit_table_resizer').style.display === 'block').to.equal(true);

                simulateEvent('mouseleave', 1, editor.editor.querySelector('table'), function (options) {
                    options.relatedTarget = editor.editor.querySelector('p');
                });
                simulateEvent('mousemove', 1, editor.editor.querySelector('p'));

                expect(editor.container.querySelector('.jodit_table_resizer').style.display === 'none').to.equal(true);
                done();
            });
            it('When move mouse over left edge of cell and press mouse button and move cursor to right in 500 pixels - resizer should be nearby next edge', function (done) {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table style="width: 100px; border-collapse: separate;" cellspacing="0">' +
                    '<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>' +
                    '</table>');

                var td = editor.editor.querySelectorAll('td')[1], box = td.getBoundingClientRect();
                simulateEvent('mousemove', 1, td, function (options) {
                    options.clientX = box.left;
                    options.offsetX = 0;
                    options.pageX = 0;
                    options.pageY = 0;
                });

                simulateEvent('mousedown', 1, editor.container.querySelector('.jodit_table_resizer'), function (options) {
                    options.clientX = box.left;
                    options.pageX = 0;
                    options.pageY = 0;
                });

                simulateEvent('mousemove', 1, editor.editorWindow, function (options) {
                    options.clientX = box.left + 500; // can move only on 5 pixels
                    options.pageX = 0;
                    options.pageY = 0;
                });

                expect(parseInt(editor.container.querySelector('.jodit_table_resizer').style.left, 10) < 55).to.equal(true);
                done();
            });
            it('When move mouse over left edge of cell and press mouse button and move cursor to right in 5 pixels - the width of the right column should decrease, the width of the left column should increase', function (done) {
                var editor = new Jodit('#table_editor');

                editor.setEditorValue('<table style="width: 100px; border-collapse: separate;" cellspacing="0">' +
                    '<tr><td>1</td><td>2</td><td>3</td><td>4</td></tr>' +
                    '</table>');

                var td = editor.editor.querySelectorAll('td')[1], box = td.getBoundingClientRect();
                simulateEvent('mousemove', 1, td, function (options) {
                    options.clientX = box.left;
                    options.offsetX = 0;
                    options.pageX = 0;
                    options.pageY = 0;
                });

                simulateEvent('mousedown', 1, editor.container.querySelector('.jodit_table_resizer'), function (options) {
                    options.clientX = box.left;
                    options.pageX = 0;
                    options.pageY = 0;
                });

                simulateEvent('mousemove', 1, editor.editorWindow, function (options) {
                    options.clientX = box.left + 5; // move on 5 pixels
                    options.pageX = 0;
                    options.pageY = 0;
                });
                simulateEvent('mouseup', 1, window, function (options) {
                    options.clientX = box.left + 5; // move on 5 pixels
                    options.pageX = 0;
                    options.pageY = 0;
                });

                expect(editor.editor.innerHTML.toLowerCase()).to.equal(
                    '<table style="width: 100px; border-collapse: separate;" cellspacing="0"><tbody>' +
                    '<tr>' +
                    '<td style="width: 30%;">1</td>' +
                    '<td style="width: 20%;">2</td>' +
                    '<td>3</td>' +
                    '<td>4</td>' +
                    '</tr>' +
                    '</tbody></table>'
                );
                done();
            });
            it('When move mouse over right edge of last cell and press mouse button and move cursor to right in 50 pixels - the width of the whole table should increase', function () {
                var editor = new Jodit('#table_editor');

                getBox().style.width = '202px';

                editor.setEditorValue('<table style="width: 100px; border-collapse: separate;" cellspacing="0">' +
                    '<tr><td>1</td><td>2</td><td>3</td><td>5</td></tr>' +
                    '</table>');
                var td = editor.editor.querySelectorAll('td')[3], box = td.getBoundingClientRect();

                simulateEvent('mousemove', 1, td, function (options) {
                    options.clientX = box.left + box.width;
                    options.offsetX = box.width;
                });

                simulateEvent('mousedown', 1, editor.container.querySelector('.jodit_table_resizer'), function (options) {
                    options.clientX = box.left + box.width;
                });

                simulateEvent('mousemove', 1, window, function (options) {
                    options.clientX = box.left + box.width + 50;
                });
                simulateEvent('mouseup', 1, window, function (options) {
                    options.clientX = box.left + box.width + 50;
                });

                expect(sortAtrtibutes(editor.editor.innerHTML.toLowerCase())).to.equal(
                    '<table cellspacing="0" style="border-collapse:separate;width:83.33%"><tbody>' +
                    '<tr>' +
                    '<td>1</td>' +
                    '<td>2</td>' +
                    '<td>3</td>' +
                    '<td>5</td>' +
                    '</tr>' +
                    '</tbody></table>'
                );
            });
            it('When move mouse over left edge of first cell and press mouse button and move cursor to left in 50 pixels - the width of the whole table should increase', function () {
                var editor = new Jodit('#table_editor');

                getBox().style.width = '202px';
                editor.setEditorValue('<table style="width: 100px">' +
                    '<tr><td>1</td><td>2</td><td>3</td><td>4</td></tr>' +
                    '</table>');

                var td = editor.editor.querySelectorAll('td')[0], box = td.getBoundingClientRect();

                simulateEvent('mousemove', 1, td, function (options) {
                    options.clientX = box.left;
                    options.offsetX = 0;
                });

                simulateEvent('mousedown', 1, editor.container.querySelector('.jodit_table_resizer'), function (options) {
                    options.clientX = box.left;
                });

                simulateEvent('mousemove', 1, window, function (options) {
                    options.clientX = box.left + 50;
                });
                simulateEvent('mouseup', 1, window, function (options) {
                    options.clientX = box.left + 50;
                });

                
                expect(sortAtrtibutes(editor.editor.innerHTML.toLowerCase())).to.equal('<table style="margin-left:27.77%;width:27.77%">' +
                    '<tbody>' +
                    '<tr>' +
                    '<td>1</td>' +
                    '<td>2</td>' +
                    '<td>3</td>' +
                    '<td>4</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>');
            });
        });
    });
    after(function() {
        table_editor.parentNode.removeChild(table_editor);
    });
    afterEach(function () {
         var i, keys = Object.keys(Jodit.instances);
         for (i = 0; i < keys.length; i += 1) {
            Jodit.instances[keys[i]].destruct();
         }
    });
});