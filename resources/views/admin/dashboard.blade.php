<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container mb-5 mt-5">
    <table class="table">
      <h2 class="text-center">Data User</h2>
      <thead>
        <tr class="text-center">
          <th scope="col">RECID</th>
          <th scope="col">NAME</th>
          <th scope="col">USERNAME</th>
          <th scope="col">EMAIL</th>
          <th scope="col">PHONE</th>
          <th scope="col">POKER USERNAME</th>
          <th scope="col">ID BANK</th>
          <th scope="col">BANK</th>
          <th scope="col">ACCOUNT NUMBER</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $item)
        <tr class="text-center">
          <td>{{$item['recid']}}</td>
          <td>{{$item['name']}}</td>
          <td>{{$item['username']}}</td>
          <td>{{$item['email']}}</td>
          <td>{{$item['phone_number']}}</td>
          <td>{{$item['member_games']['game_user_id']}}</td>
          <td>{{$item['member_bank']['id_bank']}}</td>
          <td>{{$item['member_bank']['bank_name']}}</td>
          <td>{{$item['member_bank']['account_number']}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="container mb-5 mt-5">
    <table class="table">
      <h2 class="text-center">Data Transaksi</h2>
      <thead>
        <tr class="text-center">
          <th scope="col">USERNAME</th>
          <th scope="col">REFNO</th>
          <th scope="col">APPROVEDATE</th>
          <th scope="col">TRANSACTIONTYPE</th>
          <th scope="col">FROMBANK</th>
          <th scope="col">FROM</th>
          <th scope="col">NO</th>
          <th scope="col">BANK TO</th>
          <th scope="col">NAME</th>
          <th scope="col">NO</th>
          <th scope="col">AMOUNT</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($transactions as $item)
        <tr class="text-center">
          <td>{{$item['username']}}</td>
          <td>{{$item['refNo']}}</td>
          <td>{{$item['approveDate']}}</td>
          <td>{{$item['transactionType']}}</td>
          <td>{{$item['bankFrom']}}</td>
          <td>{{$item['fromBankAccountName']}}</td>
          <td>{{$item['fromBankAccountNo']}}</td>
          <td>{{$item['bankTo']}}</td>
          <td>{{$item['toBankAcountName']}}</td>
          <td>{{$item['toBankAcountNo']}}</td>
          <td>{{$item['finalAmount']}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  -->
</body>
</html>