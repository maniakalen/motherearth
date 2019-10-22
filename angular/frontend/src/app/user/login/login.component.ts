import {AfterContentInit, AfterViewInit, Component, OnInit} from '@angular/core';
import {FormControl} from "@angular/forms";
import {AuthService} from "../auth.service";
import {Router} from "@angular/router";
import {delay} from "rxjs/operators";
import {HeaderService} from "../../header.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.less']
})
export class LoginComponent implements OnInit  {
  username = new FormControl();
  password = new FormControl();
  constructor(private auth: AuthService, private router: Router, private header: HeaderService) {}

  ngOnInit() {
    if (this.auth.isLoggedIn()) {
      this.router.navigate(['/map']);
    }
  }

  login() {
    const route = this.router;
    this.auth.login({
      username: this.username.value,
      password: this.password.value
    }, function() {
      route.navigate(['/map']);
    });
  }

}
