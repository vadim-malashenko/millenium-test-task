import View from "../View.js"

export default class Users extends View
{    
    constructor()
    {
        super({
            items: `<h1>Users</h1><ul>%items</ul`,
            item: `<li>
                <a href="#user/%id/orders">%first_name %second_name</a>
            </li>`
        })
    }
}