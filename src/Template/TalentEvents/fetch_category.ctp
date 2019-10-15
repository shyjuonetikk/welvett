<table class="table table-bordered table-striped ">
    <tr>
        <th scope="col" style="color:black !important">User</th>
        <td data-title="User"><?= ucwords($category['user']['first_name'] . ' ' . $category['user']['last_name']); ?></td>
    </tr>
    <tr>
        <th scope="col" style="color:black !important">Category</th>
        <td data-title="Category"><?= ucwords($category['eventcategory']['title']); ?></td>
    </tr>
    <tr>
        <th scope="col" style="color:black !important">Sub Category</th>            

        <td data-title="Sub category"><?= ucwords($category['eventsubcategory']['title']); ?></td>
    </tr>
</table>

