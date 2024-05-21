import View from "../View.js"

export default class UserOrders extends View
{
    #templates

    constructor()
    {
        super({
            items: `<h1>User Orders</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        %items
                    </tbody>
                </table>`,
            item: `<tr>
                    <td>%title</td>
                    <td>%price</td>
                </tr>`
        })
    }
}