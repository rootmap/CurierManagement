import Jodit from '../Jodit';
import * as consts from '../constants';
import {trim} from '../modules/Helpers';
import Dom from "../modules/Dom";

/**
 * Plug-in process entering Backspace key
 *
 * @module backspace
 */
export default function (editor: Jodit) {

    editor.events.on('afterCommand', (command) => {
        if (command === 'delete') {
            let current = editor.selection.current();
            if (current && current.firstChild && current.firstChild['tagName'] ==='BR') {
                current.removeChild(current.firstChild);
            }
            if (!trim(editor.editor.innerText) && !editor.editor.querySelector('img')) {
                editor.editor.innerHTML = '';
                editor.selection.setCursorIn(editor.editor);
            }
        }
    });

    editor.events.on('keydown', (event) => {
        if (event.which === consts.KEY_BACKSPACE || event.keyCode === consts.KEY_DELETE) {
            const toLeft: boolean = event.which === consts.KEY_BACKSPACE;

            if (!editor.selection.isCollapsed()) {
                editor.execCommand('Delete');
                return false;
            }

            const sel: Selection = editor.editorWindow.getSelection(),
                range: Range|false = sel.rangeCount ? sel.getRangeAt(0) : false;

            if (range) {
                const textNode: Node = range.startContainer.nodeType === Node.TEXT_NODE ? range.startContainer : range.startContainer.childNodes[range.startOffset];

                if (textNode && textNode.nodeType === Node.TEXT_NODE) {
                    let value = textNode.nodeValue,
                        startOffset = range.startOffset,
                        increment = toLeft ? -1 : 1;

                    while (startOffset >= 0 && startOffset <= value.length && value[startOffset + increment] === consts.INVISIBLE_SPACE) {
                        startOffset += increment;
                    }

                    if (startOffset !== range.startOffset) {
                        const oldStart = range.startOffset;
                        if (toLeft) {
                            value = value.substr(0, startOffset) + value.substr(oldStart);
                        } else {
                            value = value.substr(0, oldStart) + value.substr(startOffset);
                        }

                        textNode.nodeValue = value;
                        if (value) {
                            range.setStart(textNode, startOffset);
                            return;
                        }
                    }
                }

                if (range.startOffset === 0 && toLeft) {
                    const prevBox = Dom.prev(textNode, Dom.isBlock, editor.editor);

                    if (prevBox) {
                        editor.selection.setCursorIn(prevBox, false);
                    }

                    const container: HTMLElement = <HTMLElement>Dom.up(range.startContainer, Dom.isBlock, editor.editor);
                    const html: string = container.innerHTML.replace(consts.INVISIBLE_SPACE_REG_EXP, '');

                    if ((!html.length || html == '<br>') && !Dom.isCell(container, editor.editorWindow)) {
                        container.parentNode.removeChild(container);
                        return false;
                    }
                }
            }
        }
    })
};