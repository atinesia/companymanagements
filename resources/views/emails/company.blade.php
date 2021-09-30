<h3>Halo !</h3>
<p>New employee has been added to your company,</p>
 <br />

<table border=0>
    <tr>
        <td>First Name</td>
        <td>:</td>
        <td>{{ $employee->firts_name }}</td>
    </tr>
    <tr>
        <td>Last Name</td>
        <td>:</td>
        <td>{{ $employee->last_name }}</td>
    </tr>
    <tr>
        <td>Company</td>
        <td>:</td>
        <td>{{ $employee->company->name }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td>{{ $employee->email }}</td>
    </tr>
    <tr>
        <td>Phone</td>
        <td>:</td>
        <td>{{ $employee->phone }}</td>
    </tr>
</table>