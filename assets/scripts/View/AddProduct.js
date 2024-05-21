import View from "../View.js"

export default class AddProduct extends View
{
    #templates

    constructor()
    {
        super({
            form: `<h1>New Product</h1>
                <form id="product" style="display: grid;">
                    <label>
                        Title
                    </lable>
                    <div>
                        <input name="title" required>
                    </div>
                    <label>
                        Price
                    </label
                    </div>
                    <div>
                        <input name="price" pattern="\\d+(\\.\\d+)*" required>
                    </div>
                    <div style="margin-top: 1rem">
                        <input type="submit" value="Add">
                    </div>
                </form>`
        })
    }

    render()
    {
        return this.getTemplates().form.html({})
    }
}