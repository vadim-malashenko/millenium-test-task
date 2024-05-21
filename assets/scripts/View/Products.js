import View from "../View.js"

export default class Products extends View
{
    #templates
    
    constructor()
    {
        super({
            items: `<h1>Products</h1>
                <a href="/#products/add">Add new product</a>
                <hr/>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        %items
                    </tbody>
                </table>`,
            item: `<tr>
                    <td>%id</td>
                    <td>%title</td>
                    <td>%price</td>
                </tr>`
        })
    }
}