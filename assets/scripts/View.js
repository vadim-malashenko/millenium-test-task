import Template from "./Template.js"

export default class View
{
    #templates

    constructor(templates)
    {
        this.#templates = Object.keys(templates)
            .reduce((c, i) => (c[i] = new Template(templates[i]), c), {})
    }

    render(items)
    {
        items = items.reduce(
            (html, item) => html += this.getTemplates().item.html(item),
            ''
        )

        return this.getTemplates().items.html({items})
    }

    getTemplates()
    {
        return this.#templates
    }
}