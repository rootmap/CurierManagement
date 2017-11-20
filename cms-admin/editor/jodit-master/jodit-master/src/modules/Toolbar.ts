import Jodit from "../Jodit"
import Component from "./Component"
import {dom, each, $$, extend, camelCase} from "./Helpers"
import * as consts from "../constants";
import Dom from "./Dom";

export type ControlType = {
    controlName?: string;
    name?: string;
    mode?: number;

    data?: {[key: string]: any},

    /**
     * You can use it function for control - active/not active button
     * @param {Jodit} editor
     * @param {ControlType} btn
     * @return {boolean}
     * @see copyformat plugin
     * @example
     * ```javascript
     * var editor = new Jodit('.selectorclass', {
     *     buttons: {
     *          checkbox: {
     *              data: {
     *                  active: false,
     *              },
     *              iconURL: 'checkbox.png',
     *              exec: function (a, b, btn) {
     *                  btn.data.active = !btn.data.active;
     *              },
     *              isActive: function (editor, btn) {
     *                  return !!btn.data.active;
     *              }
     *          }
     *     }
     * })
     * ```
     */
    isActive?: (editor: Jodit, btn: ControlType) => boolean,

    /**
     * Drop-down list. A hash or array. You must specify the command which will be submitted for the hash key (or array value) (see .[[Jodit.execCommand]] or define 'exec' function. See example
     * @example
     * ```javascript
     * new Jodit('#editor2', {
     *     buttons: Jodit.defaultOptions.buttons.concat([{
     *        name: 'listsss',
     *        iconURL: 'stuf/dummy.png',
     *        list: {
     *            h1: 'insert Header 1',
     *            h2: 'insert Header 2',
     *            clear: 'Empty editor',
     *        },
     *        exec: (editor, current, control) => {
     *             var key = control.args[0],
     *                value = control.args[1];
     *
     *             if (key === 'clear') {
     *                 this.setEditorValue('');
     *                 return;
     *             }
     *             this.selection.insertNode(Jodit.modules.Dom.create(key, ''));
     *             this.events.fire('errorMessage', ['Was inserted ' + value]);
     *        },
     *        template: function (key, value) {
     *            return '<div>' + value + '</div>';
     *        }
     *  });
     *  ```
     */
    list?: {[key: string]: string} | string[];

    /**
     * The command executes when the button is pressed. Allowed all {@link https://developer.mozilla.org/ru/docs/Web/API/Document/execCommand#commands} and several specific [[Jodit.execCommand]]
     */
    command?: string;
    tagRegExp?: RegExp;

    /**
     * Tag list:  when cursor inward tag from this list, button will be highlighted
     */
    tags?: string[];
    options?: any;
    css?: {[key: string]: string|string[]}|{[key: string]: (editor: Jodit, value: string) => boolean};
    /**
     * String name for existing icons.
     * @example
     * ```javascript
     * var editor = new Jodit('.editor', {
     *  buttons: [
     *      {
     *          icon: 'source',
     *          exec: function (editor) {
     *              editor.toggleMode();
     *          }
     *      }
     *  ]
     * })
     * ```
     */
    icon?: string;
    /**
     * Use this property if you want set background image for the button. This icon can be 16 * 16 px in SVG or another image formats
     */
    iconURL?: string;

    /**
     * Buttons hint
     */
    tooltip?: string;

    /**
     * This function will be executed when the button is pressed.
     */
    exec?: (editor: Jodit, current: Node|false, control: ControlType, originalEvent: Event,  btn: HTMLLIElement) => void;

    args?: any[];
    cols?: number;

    /**
     * The method which will be called for each element of button.list
     */
    template?: (editor: Jodit, key: string, value: string) => string;

    /**
     * After click on the button it will show popup element which consist value that this function returned
     * @example
     * ```javascript
     * var editor = new Jodit('.editor', {
     *    buttons: [
     *      {
     *          icon: "insertCode",
     *          popup: function (editor) {
     *              var div = dccument.createElement('div'), button = dccument.createElement('button');
     *              div.innerHTML = 'Hi! Click button and enter your code';
     *              button.innerHTML = 'Click me';
     *
     *              div.appendChild(button);
     *
     *              button.addEventListener('click', function (e) {
     *                  editor.selection.insertHTML(prompt("Enter your code"));
     *                  return false;
     *              });
     *              return div;
     *          }
     *      }
     *    ]
     * });
     * ```
     */
    popup?:(editor: Jodit, current: Node|false, control: ControlType, close: Function) => string|HTMLElement|false;
}

type ButtonType = {
    btn: HTMLLIElement,
    control: ControlType,
    name: string,
}


export default class Toolbar extends Component{
    static icons = {};
    container: HTMLDivElement;
    private popup: HTMLDivElement;
    private list: HTMLDivElement;


    private __popapOpened: boolean = false;
    private __listOpened: boolean = false;

    /**
     *
     * @param {Jodit} editor
     *
     */
    constructor(editor: Jodit) {
        super(editor);
        this.container = <HTMLDivElement>dom('<div class="jodit_toolbar"/>', editor.ownerDocument);
        this.popup = <HTMLDivElement>dom('<div class="jodit_toolbar_popup"/>', editor.ownerDocument);
        this.list = <HTMLDivElement>dom('<ul class="jodit_dropdownlist"/>', editor.ownerDocument);

        this.initEvents();
    }

    /**
     * Return SVG icon
     *
     * @param {string} name icon
     * @param {string|boolean} [defaultValue='<span></span>']
     * @return {string}
     */
    static getIcon(name: string, defaultValue:string|false = '<span></span>') {
        return Toolbar.icons[name] !== undefined ? Toolbar.icons[name] : defaultValue;
    }

    /**
     *
     * @param {HTMLLIElement|HTMLAnchorElement} btn
     * @param {HTMLElement} content
     * @param {boolean} [rightAlign=false] Open popup on right side
     */
    openPopup(btn: HTMLLIElement|HTMLAnchorElement, content: string|HTMLElement|false, rightAlign: boolean = false) {
        this.closeAll();
        if (!content) {
            return;
        }
        btn.classList.add('jodit_popup_open');
        btn.appendChild(this.popup);

        this.__popapOpened = true;

        this.popup.innerHTML = '';
        this.popup.appendChild(dom(content, this.jodit.ownerDocument));
        this.popup.style.display = 'block';

        this.popup.classList.toggle('jodit_right', rightAlign);
    }

    /**
     *
     */
    openList(btn: HTMLLIElement) {
        btn.classList.add('jodit_dropdown_open');
        this.closeAll();
        this.__listOpened = true;
        this.list.style.display = 'block';
    }

    /**
     *
     */
    closeAll = () => {
        this.list.innerHTML = '';
        this.popup.innerHTML = '';
        this.popup.style.display = 'none';
        this.list.style.display = 'none';

        $$('.jodit_dropdown_open, .jodit_popap_open', this.container).forEach((btn) => {
            btn.classList.remove('jodit_dropdown_open', 'jodit_popap_open');
        });

        if (this.__popapOpened && this.jodit.selection) {
            this.jodit.selection.clear();
        }

        this.__popapOpened = false;
        this.__listOpened = false;
    };

    private static __toggleButton(btn: HTMLElement, enable: boolean) {
        btn.classList.toggle('jodit_disabled', !enable);
        if (enable) {
            if (btn.hasAttribute('disabled')) {
                btn.removeAttribute('disabled');
            }
        } else {
            if (!btn.hasAttribute('disabled')) {
                btn.setAttribute('disabled', 'disabled');
            }
        }
    }

    private checkActiveButtons(element: Node|false) {
        const active_class = 'jodit_active',
            getCSS = (elm: HTMLElement, key: string): string => {
                return this.jodit.editorWindow.getComputedStyle(elm).getPropertyValue(key).toString()
            },

            checkActiveStatus = (
                btn: ButtonType,
                cssObject: {[key: string]: string|string[]}|{[key: string]: (editor: Jodit, value: string) => boolean},
                node: HTMLElement
            ) => {
                let matches: number = 0,
                    total: number = 0;

                Object.keys(cssObject).forEach((cssProperty) => {
                    const cssValue = cssObject[cssProperty];
                    if (typeof cssValue === 'function') {
                        if (cssValue(
                                this.jodit,
                                getCSS(node, cssProperty).toLowerCase()
                            )) {
                            matches += 1;
                        }
                    } else {
                        if (cssValue.indexOf(getCSS(node, cssProperty).toLowerCase()) !== -1) {
                            matches += 1;
                        }
                    }
                    total += 1;
                });
                if (total === matches) {
                    btn.btn.classList.add(active_class);
                }
            };

        this.buttonList.forEach((button: ButtonType) => {
            button.btn.classList.remove(active_class);

            const mode =  (button.control === undefined || button.control.mode === undefined) ? consts.MODE_WYSIWYG : button.control.mode;

            Toolbar.__toggleButton(button.btn, mode === consts.MODE_SPLIT || mode === this.jodit.getRealMode());

            if (typeof button.control.isActive === 'function') {
                button.btn.classList.toggle(active_class,  button.control.isActive(this.jodit, button.control));
            }

            if (!element) {
                return;
            }

            let tags,
                elm,
                css;



            if (button.control.tags || (button.control.options && button.control.options.tags)) {
                tags = button.control.tags || (button.control.options && button.control.options.tags);

                elm = element;
                Dom.up(elm, (node: Node) => {
                    if (tags.indexOf(node.nodeName.toLowerCase()) !== -1) {
                        button.btn.classList.add(active_class);
                        return true;
                    }
                }, this.jodit.editor);
            }

            //activate by supposed css
            if (button.control.css || (button.control.options && button.control.options.css)) {
                css = button.control.css || (button.control.options && button.control.options.css);

                elm = element;
                Dom.up(elm, (node: HTMLElement) => {
                    if (node && node.nodeType !== Node.TEXT_NODE/* && !node.classList.contains(active_class)*/) {
                        checkActiveStatus(button, css, node);
                    }
                }, this.jodit.editor);
            }
        });
    }

    private defaultControl:ControlType  = {
        template: (editor: Jodit, key: string, value: string) => (this.jodit.i18n(value))
    };

    private buttonList: ButtonType[] = [];
    /**
     *
     */
    addButton(item: string|ControlType, controlOption?: ControlType, content?: string, target?: HTMLElement) {

        let control: ControlType = extend(true, {}, controlOption, this.defaultControl);

        const btn: HTMLLIElement = <HTMLLIElement>dom('<li>' +
                    '<a href="javascript:void(0)"></a>' +
                    '<div class="jodit_tooltip"></div>' +
                '</li>', this.jodit.ownerDocument),
            name: string = typeof item === 'string' ? item : (item.name || 'empty'),
            icon: string = typeof item === 'string' ? item : (item.icon || item.name || 'empty'),
            a: HTMLAnchorElement = btn.querySelector('a');

        let iconSVG: string|false;

        if (!this.jodit.options.textIcons) {
            iconSVG = Toolbar.getIcon(icon, false);

            if (iconSVG === false) {
                iconSVG = Toolbar.getIcon(typeof control.name === 'string' ? control.name : 'empty');
            }
        } else {
            iconSVG = `<span>${name}</span>`;
        }


        //btn.control =  control;

        const clearName = name.replace(/[^a-zA-Z0-9]/g, '_');

        btn.classList.add('jodit_toolbar_btn'); // fix for ie You can not simply add class and add second parameter
        btn.classList.add('jodit_toolbar_btn-' + clearName);


        this.jodit.events.on(camelCase('can-' + clearName), (enable) => {
            Toolbar.__toggleButton(btn, enable);
        });

        let iconElement =  dom(<string>iconSVG, this.jodit.ownerDocument);

        if (iconElement && iconElement.nodeType !== Node.TEXT_NODE) {
            iconElement.classList.add('jodit_icon', 'jodit_icon_' + clearName);
        }

        a.appendChild(iconElement);

        if (control === undefined || typeof(control) !== 'object') {
            control = {command: name};
        }

        if (content !== undefined && content !== '') {
            a.innerHTML = content;
        }

        if (control.list) {
            btn.classList.add('jodit_with_dropdownlist');
            a.appendChild(dom('<span class="jodit_with_dropdownlist-trigger"></span>', this.jodit.ownerDocument))
        }

        if (control.iconURL) {
            a.style.backgroundImage =  'url(' + control.iconURL + ')'
        }

        if (control.tooltip) {
            btn.querySelector('.jodit_tooltip').innerHTML = this.jodit.i18n(control.tooltip);
        } else {
            btn.removeChild(btn.querySelector('.jodit_tooltip'));
        }

        this.__on(btn, 'mousedown touchend', (originalEvent) => {
            originalEvent.stopImmediatePropagation();
            originalEvent.preventDefault();

            if (btn.classList.contains('jodit_disabled')) {
                return false;
            }


            if (control.list) {
                this.openList(btn);
                each(control.list, (key: string, value: string) => {
                    let elm;
                    if (this.jodit.options.controls[value] !== undefined) {
                        elm = this.addButton(value, this.jodit.options.controls[value], '', target); // list like array {"align": {list: ["left", "right"]}}
                    } else if (this.jodit.options.controls[key] !== undefined) {
                        elm = this.addButton(key, extend({}, this.jodit.options.controls[key], value),'', target); // list like object {"align": {list: {"left": {exec: alert}, "right": {}}}}
                    } else {
                        elm = this.addButton(key, {
                                exec: control.exec,
                                command: control.command,
                                args: [
                                    (control.args && control.args[0]) || key,
                                    (control.args && control.args[1]) || value
                                ]
                            },
                            control.template && control.template(
                            this.jodit,
                            key,
                            value
                            ),
                            target
                        );
                    }

                    this.list.appendChild(elm);
                });
                btn.appendChild(this.list);
            } else if (control.exec !== undefined && typeof control.exec === 'function') {
                control.exec(
                    this.jodit,
                    target || this.jodit.selection.current(),
                    control,
                    originalEvent,
                    btn
                );
                this.checkActiveButtons(false);
                this.jodit.setEditorValue();
                this.jodit.events.fire('hidePopup');
                this.closeAll();
            } else if (control.popup !== undefined && typeof control.popup === 'function') {
                this.openPopup(btn, control.popup(
                    this.jodit,
                    target || this.jodit.selection.current(),
                    control,
                    () => {
                        this.closeAll();
                        this.jodit.selection.clear(); // remove all markers
                    }
                ));
            } else {
                if (control.command || name) {
                    this.jodit.execCommand(control.command || name, (control.args && control.args[0]) || false, (control.args && control.args[1]) || null);
                    this.closeAll();
                }
            }
        });

        this.buttonList.push({
            control,
            btn,
            name,
        });

        return btn;
    }

    /**
     *
     * @param {Array|Object} buttons
     * @param {HTMLDivElement} container
     * @param {HTMLElement} target Work element
     */
    build(buttons: Array<ControlType|string>, container: HTMLElement, target?: HTMLElement) {
        let lastBtnSeparator: boolean = false;

        this.container.innerHTML = '';

        (<Array<ControlType|string>>buttons).forEach((button: ControlType|string) => {
            const name: string = typeof button === 'string' ? <string>button : button.name;

            if (this.jodit.options.removeButtons.indexOf(name) !== -1) {
                return;
            }

            switch (name) {
                case "\n":
                    this.container.appendChild(dom('<li class="jodit_toolbar_btn jodit_toolbar_btn-break"></li>', this.jodit.ownerDocument));
                    break;
                case '|':
                    if (!lastBtnSeparator) {
                        lastBtnSeparator = true;
                        this.container.appendChild(dom('<li class="jodit_toolbar_btn jodit_toolbar_btn-separator"></li>', this.jodit.ownerDocument));
                    }
                    break;
                default:
                    let control: string|ControlType = button;

                    lastBtnSeparator = false;

                    if (typeof control !== 'object' && this.jodit.options.controls[control] !== undefined) {
                        control = this.jodit.options.controls[control];
                    }

                    if (typeof control === 'object' && this.jodit.options.controls[control.name] !== undefined) {
                        control = {...this.jodit.options.controls[control.name], ...control};
                    }

                    if (typeof control !== 'object') {
                        throw new Error('Need ControlType ' + control);
                    }

                    this.container.appendChild(this.addButton(button, <ControlType>control, '', target));
            }

            if (name !== '|') {

            } else {

            }
        });

        if (this.container.parentNode !== container) {
            container.appendChild(this.container);
        }

        this.checkActiveButtons(false);
    }

    private initEvents = () => {
        this.__on(this.popup, 'mousedown touchstart', (e: MouseEvent) => {e.stopPropagation()})
            .__on(this.list,'mousedown touchstart', (e: MouseEvent) => {e.stopPropagation()})
            .__on(this.jodit.ownerWindow, 'mousedown touchstart', () => {
                if (this.__popapOpened || this.__listOpened) {
                    this.closeAll();
                }
            });

        this.jodit.events.on('mousedown mouseup keydown change afterSetMode focus', () => {
            const callback = () => {
                if (this.jodit.selection) {
                    this.checkActiveButtons(this.jodit.selection.current())
                }
            };
            if (this.jodit.options.observer.timeout) {
                setTimeout(callback, this.jodit.options.observer.timeout)
            } else {
                callback();
            }
        });
    };
}