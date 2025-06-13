<x-employeeLayout>
    <div>
        <form action="loginRequest.php" method="POST">
            <input type="number" name="employeeNr" placeholder="Medewerker Nummer" min="1">
            <input type="password" name="password" placeholder="Wachtwoord">
            <button type="submit">
        </form>
        <div class='errorMessage'>{{$_SESSION['login_error']}}</div>
    </div>
</x-employeeLayout>