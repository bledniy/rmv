<style>
	.table {
		width: 100%;
		margin-bottom: 1rem;
		color: #212529
	}

	.table td, .table th {
		padding: .75rem;
		vertical-align: top;
		border-top: 1px solid #dee2e6
	}

	.table thead th {
		vertical-align: bottom;
		border-bottom: 2px solid #dee2e6
	}

	.table tbody + tbody {
		border-top: 2px solid #dee2e6
	}

	.table-sm td, .table-sm th {
		padding: .3rem
	}

	.table-bordered {
		border: 1px solid #dee2e6
	}

	.table-bordered td, .table-bordered th {
		border: 1px solid #dee2e6
	}

	.table-bordered thead td, .table-bordered thead th {
		border-bottom-width: 2px
	}

	.table-borderless tbody + tbody, .table-borderless td, .table-borderless th, .table-borderless thead th {
		border: 0
	}

	.table-striped tbody tr:nth-of-type(odd) {
		background-color: rgba(0, 0, 0, .05)
	}

	.table-hover tbody tr:hover {
		color: #212529;
		background-color: rgba(0, 0, 0, .075)
	}

	.table-primary, .table-primary > td, .table-primary > th {
		background-color: #b8daff
	}

	.table-primary tbody + tbody, .table-primary td, .table-primary th, .table-primary thead th {
		border-color: #7abaff
	}

	.table-hover .table-primary:hover {
		background-color: #9fcdff
	}

	.table-hover .table-primary:hover > td, .table-hover .table-primary:hover > th {
		background-color: #9fcdff
	}

	.table-secondary, .table-secondary > td, .table-secondary > th {
		background-color: #d6d8db
	}

	.table-secondary tbody + tbody, .table-secondary td, .table-secondary th, .table-secondary thead th {
		border-color: #b3b7bb
	}

	.table-hover .table-secondary:hover {
		background-color: #c8cbcf
	}

	.table-hover .table-secondary:hover > td, .table-hover .table-secondary:hover > th {
		background-color: #c8cbcf
	}

	.table-success, .table-success > td, .table-success > th {
		background-color: #c3e6cb
	}

	.table-success tbody + tbody, .table-success td, .table-success th, .table-success thead th {
		border-color: #8fd19e
	}

	.table-hover .table-success:hover {
		background-color: #b1dfbb
	}

	.table-hover .table-success:hover > td, .table-hover .table-success:hover > th {
		background-color: #b1dfbb
	}

	.table-info, .table-info > td, .table-info > th {
		background-color: #bee5eb
	}

	.table-info tbody + tbody, .table-info td, .table-info th, .table-info thead th {
		border-color: #86cfda
	}

	.table-hover .table-info:hover {
		background-color: #abdde5
	}

	.table-hover .table-info:hover > td, .table-hover .table-info:hover > th {
		background-color: #abdde5
	}

	.table-warning, .table-warning > td, .table-warning > th {
		background-color: #ffeeba
	}

	.table-warning tbody + tbody, .table-warning td, .table-warning th, .table-warning thead th {
		border-color: #ffdf7e
	}

	.table-hover .table-warning:hover {
		background-color: #ffe8a1
	}

	.table-hover .table-warning:hover > td, .table-hover .table-warning:hover > th {
		background-color: #ffe8a1
	}

	.table-danger, .table-danger > td, .table-danger > th {
		background-color: #f5c6cb
	}

	.table-danger tbody + tbody, .table-danger td, .table-danger th, .table-danger thead th {
		border-color: #ed969e
	}

	.table-hover .table-danger:hover {
		background-color: #f1b0b7
	}

	.table-hover .table-danger:hover > td, .table-hover .table-danger:hover > th {
		background-color: #f1b0b7
	}

	.table-light, .table-light > td, .table-light > th {
		background-color: #fdfdfe
	}

	.table-light tbody + tbody, .table-light td, .table-light th, .table-light thead th {
		border-color: #fbfcfc
	}

	.table-hover .table-light:hover {
		background-color: #ececf6
	}

	.table-hover .table-light:hover > td, .table-hover .table-light:hover > th {
		background-color: #ececf6
	}

	.table-dark, .table-dark > td, .table-dark > th {
		background-color: #c6c8ca
	}

	.table-dark tbody + tbody, .table-dark td, .table-dark th, .table-dark thead th {
		border-color: #95999c
	}

	.table-hover .table-dark:hover {
		background-color: #b9bbbe
	}

	.table-hover .table-dark:hover > td, .table-hover .table-dark:hover > th {
		background-color: #b9bbbe
	}

	.table-active, .table-active > td, .table-active > th {
		background-color: rgba(0, 0, 0, .075)
	}

	.table-hover .table-active:hover {
		background-color: rgba(0, 0, 0, .075)
	}

	.table-hover .table-active:hover > td, .table-hover .table-active:hover > th {
		background-color: rgba(0, 0, 0, .075)
	}

	.table .thead-dark th {
		color: #fff;
		background-color: #343a40;
		border-color: #454d55
	}

	.table .thead-light th {
		color: #495057;
		background-color: #e9ecef;
		border-color: #dee2e6
	}

	.table-dark {
		color: #fff;
		background-color: #343a40
	}

	.table-dark td, .table-dark th, .table-dark thead th {
		border-color: #454d55
	}

	.table-dark.table-bordered {
		border: 0
	}

	.table-dark.table-striped tbody tr:nth-of-type(odd) {
		background-color: rgba(255, 255, 255, .05)
	}

	.table-dark.table-hover tbody tr:hover {
		color: #fff;
		background-color: rgba(255, 255, 255, .075)
	}

	@media (max-width: 575.98px) {
		.table-responsive-sm {
			display: block;
			width: 100%;
			overflow-x: auto;
			-webkit-overflow-scrolling: touch
		}

		.table-responsive-sm > .table-bordered {
			border: 0
		}
	}

	@media (max-width: 767.98px) {
		.table-responsive-md {
			display: block;
			width: 100%;
			overflow-x: auto;
			-webkit-overflow-scrolling: touch
		}

		.table-responsive-md > .table-bordered {
			border: 0
		}
	}

	@media (max-width: 991.98px) {
		.table-responsive-lg {
			display: block;
			width: 100%;
			overflow-x: auto;
			-webkit-overflow-scrolling: touch
		}

		.table-responsive-lg > .table-bordered {
			border: 0
		}
	}

	@media (max-width: 1199.98px) {
		.table-responsive-xl {
			display: block;
			width: 100%;
			overflow-x: auto;
			-webkit-overflow-scrolling: touch
		}

		.table-responsive-xl > .table-bordered {
			border: 0
		}
	}

	.table-responsive {
		display: block;
		width: 100%;
		overflow-x: auto;
		-webkit-overflow-scrolling: touch
	}

	.table-responsive > .table-bordered {
		border: 0
	}

	.container {
		width: 970px;
		padding-right: 15px;
		padding-left: 15px;
		margin-right: auto;
		margin-left: auto
	}
</style>
<style>
    body,
    .body {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        width: 100%;
        min-width: 100%;
        height: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        font-family: Helvetica, Arial, sans-serif;
        line-height: 24px;
        font-weight: normal;
        font-size: 16px;
        box-sizing: border-box;
    }

    img {
        border: 0 none;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
    }

    a img {
        border: 0 none;
    }

    table:not([class^=s-]) {
        font-family: Helvetica, Arial, sans-serif;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
    }

    table:not([class^=s-]) {
        border-spacing: 0px;
        border-collapse: collapse;
    }

    table:not([class^=s-]) td {
        border-spacing: 0px;
        border-collapse: collapse;
    }

    table[align=center] {
        margin: 0 auto;
    }

    th,
    td,
    p {
        text-align: left;
        line-height: 24px;
        font-size: 16px;
        margin: 0;
    }

    .btn {
        border-radius: 4px;
        border-collapse: separate !important;
    }

    .btn td {
        border-radius: 4px;
        text-align: center;
    }

    .btn td a {
        font-size: 16px;
        font-family: Helvetica, Arial, sans-serif;
        text-decoration: none;
        border-radius: 4px;
        padding: 8px 12px;
        line-height: 20px;
        border: 1px solid #e9703e;
        display: inline-block;
        font-weight: normal;
        white-space: nowrap;
    }

    .btn-primary td {
        background-color: #007bff;
    }

    .btn-primary td a {
        background-color: #007bff;
        color: #ffffff;
        border-color: #007bff;
    }

    .btn-secondary td {
        background-color: #868e96;
    }

    .btn-secondary td a {
        background-color: #868e96;
        color: #ffffff;
        border-color: #868e96;
    }

    .btn-success td {
        background-color: #28a745;
    }

    .btn-success td a {
        background-color: #28a745;
        color: #ffffff;
        border-color: #28a745;
    }

    .btn-danger td {
        background-color: #dc3545;
    }

    .btn-danger td a {
        background-color: #dc3545;
        color: #ffffff;
        border-color: #dc3545;
    }

    .btn-warning td {
        background-color: #ffc107;
    }

    .btn-warning td a {
        background-color: #ffc107;
        color: #111111;
        border-color: #ffc107;
    }

    .btn-info td {
        background-color: #17a2b8;
    }

    .btn-info td a {
        background-color: #17a2b8;
        color: #ffffff;
        border-color: #17a2b8;
    }

    .btn-light td {
        background-color: #f8f9fa;
    }

    .btn-light td a {
        background-color: #f8f9fa;
        color: #111111;
        border-color: #f8f9fa;
    }

    .btn-dark td {
        background-color: #343a40;
    }

    .btn-dark td a {
        background-color: #343a40;
        color: #ffffff;
        border-color: #343a40;
    }

    .btn-outline-primary td {
        background-color: transparent;
        border-color: #007bff;
    }

    .btn-outline-primary td a {
        background-color: transparent;
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-secondary td {
        background-color: transparent;
        border-color: #868e96;
    }

    .btn-outline-secondary td a {
        background-color: transparent;
        border-color: #868e96;
        color: #868e96;
    }

    .btn-outline-success td {
        background-color: transparent;
        border-color: #28a745;
    }

    .btn-outline-success td a {
        background-color: transparent;
        border-color: #28a745;
        color: #28a745;
    }

    .btn-outline-danger td {
        background-color: transparent;
        border-color: #dc3545;
    }

    .btn-outline-danger td a {
        background-color: transparent;
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-warning td {
        background-color: transparent;
        border-color: #ffc107;
    }

    .btn-outline-warning td a {
        background-color: transparent;
        border-color: #ffc107;
        color: #ffc107;
    }

    .btn-outline-info td {
        background-color: transparent;
        border-color: #17a2b8;
    }

    .btn-outline-info td a {
        background-color: transparent;
        border-color: #17a2b8;
        color: #17a2b8;
    }

    .btn-outline-light td {
        background-color: transparent;
        border-color: #f8f9fa;
    }

    .btn-outline-light td a {
        background-color: transparent;
        border-color: #f8f9fa;
        color: #f8f9fa;
    }

    .btn-outline-dark td {
        background-color: transparent;
        border-color: #343a40;
    }

    .btn-outline-dark td a {
        background-color: transparent;
        border-color: #343a40;
        color: #343a40;
    }

    .btn-sm td a {
        font-size: 14px;
        padding: 4px 8px;
        line-height: 21px;
        border-radius: 3.2px;
    }

    .btn-lg td a {
        font-size: 20px;
        padding: 8px 16px;
        line-height: 30px;
        border-radius: 4.8px;
    }

    .d-mobile {
        display: none;
    }

    .d-desktop {
        display: block;
    }

    table.row {
        margin-right: -15px;
        margin-left: -15px;
        table-layout: fixed;
        width: 100%;
    }

    th.col-1,
    th.col-lg-1,
    th.col-2,
    th.col-lg-2,
    th.col-3,
    th.col-lg-3,
    th.col-4,
    th.col-lg-4,
    th.col-5,
    th.col-lg-5,
    th.col-6,
    th.col-lg-6,
    th.col-7,
    th.col-lg-7,
    th.col-8,
    th.col-lg-8,
    th.col-9,
    th.col-lg-9,
    th.col-10,
    th.col-lg-10,
    th.col-11,
    th.col-lg-11,
    th.col-12,
    th.col-lg-12 {
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
        font-weight: normal;
    }

    table.no-gutters {
        margin-right: 0;
        margin-left: 0;
    }

    .no-gutters > thead > tr > th.col-1,
    .no-gutters > thead > tr > th.col-lg-1,
    .no-gutters > thead > tr > th.col-2,
    .no-gutters > thead > tr > th.col-lg-2,
    .no-gutters > thead > tr > th.col-3,
    .no-gutters > thead > tr > th.col-lg-3,
    .no-gutters > thead > tr > th.col-4,
    .no-gutters > thead > tr > th.col-lg-4,
    .no-gutters > thead > tr > th.col-5,
    .no-gutters > thead > tr > th.col-lg-5,
    .no-gutters > thead > tr > th.col-6,
    .no-gutters > thead > tr > th.col-lg-6,
    .no-gutters > thead > tr > th.col-7,
    .no-gutters > thead > tr > th.col-lg-7,
    .no-gutters > thead > tr > th.col-8,
    .no-gutters > thead > tr > th.col-lg-8,
    .no-gutters > thead > tr > th.col-9,
    .no-gutters > thead > tr > th.col-lg-9,
    .no-gutters > thead > tr > th.col-10,
    .no-gutters > thead > tr > th.col-lg-10,
    .no-gutters > thead > tr > th.col-11,
    .no-gutters > thead > tr > th.col-lg-11,
    .no-gutters > thead > tr > th.col-12,
    .no-gutters > thead > tr > th.col-lg-12 {
        padding-right: 0;
        padding-left: 0;
    }

    th.col-1,
    th.col-lg-1 {
        width: 8.333333%;
    }

    th.col-2,
    th.col-lg-2 {
        width: 16.666667%;
    }

    th.col-3,
    th.col-lg-3 {
        width: 25%;
    }

    th.col-4,
    th.col-lg-4 {
        width: 33.333333%;
    }

    th.col-5,
    th.col-lg-5 {
        width: 41.666667%;
    }

    th.col-6,
    th.col-lg-6 {
        width: 50%;
    }

    th.col-7,
    th.col-lg-7 {
        width: 58.333333%;
    }

    th.col-8,
    th.col-lg-8 {
        width: 66.666667%;
    }

    th.col-9,
    th.col-lg-9 {
        width: 75%;
    }

    th.col-10,
    th.col-lg-10 {
        width: 83.333333%;
    }

    th.col-11,
    th.col-lg-11 {
        width: 91.666667%;
    }

    th.col-12,
    th.col-lg-12 {
        width: 100%;
    }

    .card {
        background-color: #ffffff;
        border-radius: 4px;
        border: 1px solid #dee2e6;
        border-collapse: separate !important;
        width: 100%;
        overflow: hidden;
    }

    .card > tbody > tr > td {
        width: 100%;
    }

    .card .card-body {
        width: 100%;
    }

    .card .card-body > tbody > tr > td {
        padding: 20px;
        width: 100%;
    }

    .container {
        width: 100%;
    }

    .container > tbody > tr > td {
        padding: 0 16px;
    }

    .container > tbody > tr > td > table {
        width: 100%;
        max-width: 600px;
    }

    .container-fluid {
        width: 100%;
    }

    .container-fluid > tbody > tr > td {
        padding: 0 16px;
        width: 100%;
    }

    .badge > tbody > tr > td {
        display: inline-block;
        padding: 4px 6.4px;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 4px;
    }

    .badge-pill > tbody > tr > td {
        padding-right: 9.6px;
        padding-left: 9.6px;
        border-radius: 160px;
    }

    .badge-primary > tbody > tr > td {
        color: #ffffff;
        background-color: #007bff;
    }

    .badge-secondary > tbody > tr > td {
        color: #ffffff;
        background-color: #868e96;
    }

    .badge-success > tbody > tr > td {
        color: #ffffff;
        background-color: #28a745;
    }

    .badge-danger > tbody > tr > td {
        color: #ffffff;
        background-color: #dc3545;
    }

    .badge-warning > tbody > tr > td {
        color: #111111;
        background-color: #ffc107;
    }

    .badge-info > tbody > tr > td {
        color: #ffffff;
        background-color: #17a2b8;
    }

    .badge-light > tbody > tr > td {
        color: #111111;
        background-color: #f8f9fa;
    }

    .badge-dark > tbody > tr > td {
        color: #ffffff;
        background-color: #343a40;
    }

    h1 .badge > tbody > tr > td {
        font-size: 27px;
    }

    h2 .badge > tbody > tr > td {
        font-size: 24px;
    }

    h3 .badge > tbody > tr > td {
        font-size: 21px;
    }

    h4 .badge > tbody > tr > td {
        font-size: 18px;
    }

    h5 .badge > tbody > tr > td {
        font-size: 15px;
    }

    h6 .badge > tbody > tr > td {
        font-size: 12px;
    }

    .table {
        width: 100%;
        max-width: 100%;
        background-color: #ffffff;
    }

    .table > thead > tr > th {
        text-align: left;
    }

    .table > thead > tr > th,
    .table > tbody > tr > td {
        padding: 12px;
        vertical-align: top;
        border-top: 1px solid #e9ecef;
    }

    .table > thead > th {
        vertical-align: bottom;
        border-bottom: 2px solid #e9ecef;
    }

    .table-unstyled {
        width: 100%;
        max-width: 100%;
        background-color: transparent;
    }

    .table-unstyled td,
    .table-unstyled th {
        border-top: 0;
        border-bottom: 0;
        text-align: left;
    }

    .table-sm > thead > tr > th,
    .table-sm > tbody > tr > td {
        padding: 4.8px;
    }

    .table-bordered {
        border: 1px solid #e9ecef;
    }

    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > td {
        border: 1px solid #e9ecef;
    }

    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
        border-bottom-width: 2px;
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .table-primary,
    .table-primary > th,
    .table-primary > td {
        background-color: #cce5ff;
    }

    .table-secondary,
    .table-secondary > th,
    .table-secondary > td {
        background-color: #f3f4f5;
    }

    .table-success,
    .table-success > th,
    .table-success > td {
        background-color: #afecbd;
    }

    .table-danger,
    .table-danger > th,
    .table-danger > td {
        background-color: #fae3e5;
    }

    .table-warning,
    .table-warning > th,
    .table-warning > td {
        background-color: #fff4d3;
    }

    .table-info,
    .table-info > th,
    .table-info > td {
        background-color: #a7e9f4;
    }

    .table-light,
    .table-light > th,
    .table-light > td {
        background-color: white;
    }

    .table-dark,
    .table-dark > th,
    .table-dark > td {
        background-color: #96a0aa;
    }

    .thead-inverse > thead > tr > th {
        color: #ffffff;
        background-color: #212529;
    }

    .thead-default > thead > tr > th {
        color: #495057;
        background-color: #e9ecef;
    }

    .table-inverse {
        color: #ffffff;
        background-color: #212529;
    }

    .table-inverse > thead > tr > th,
    .table-inverse > tbody > tr > td {
        border-color: #32383e;
    }

    .table-inverse.table-bordered {
        border: 0;
    }

    .table-inverse.table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #2c3034;
    }

    div.hr {
        width: 100%;
        border: 0;
        margin: 20px 0;
    }

    div.hr > table {
        width: 100%;
    }

    div.hr > table > tbody > tr > td {
        width: 100%;
        border-top: 1px solid #dddddd;
        height: 1px;
        width: 100%;
    }

    .alert {
        border-collapse: separate !important;
        border: 0;
        width: 100%;
    }

    .alert > tbody > tr > td {
        padding: 12px 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-primary td {
        background-color: #cce5ff;
        border-color: #b3d7ff;
        color: #003166;
    }

    .alert-primary td .hr > table > tbody > tr > td {
        border-top: 1px solid #b3d7ff;
    }

    .alert-secondary td {
        background-color: #f3f4f5;
        border-color: #e6e7e9;
        color: #3d4246;
    }

    .alert-secondary td .hr > table > tbody > tr > td {
        border-top: 1px solid #e6e7e9;
    }

    .alert-success td {
        background-color: #afecbd;
        border-color: #9be7ac;
        color: #0a2c12;
    }

    .alert-success td .hr > table > tbody > tr > td {
        border-top: 1px solid #9be7ac;
    }

    .alert-danger td {
        background-color: #fae3e5;
        border-color: #f6cdd1;
        color: #66121a;
    }

    .alert-danger td .hr > table > tbody > tr > td {
        border-top: 1px solid #f6cdd1;
    }

    .alert-warning td {
        background-color: #fff4d3;
        border-color: #ffeeba;
        color: #6d5200;
    }

    .alert-warning td .hr > table > tbody > tr > td {
        border-top: 1px solid #ffeeba;
    }

    .alert-info td {
        background-color: #a7e9f4;
        border-color: #90e4f1;
        color: #062a30;
    }

    .alert-info td .hr > table > tbody > tr > td {
        border-top: 1px solid #90e4f1;
    }

    .alert-light td {
        background-color: white;
        border-color: white;
        color: #9fadba;
    }

    .alert-light td .hr > table > tbody > tr > td {
        border-top: 1px solid white;
    }

    .alert-dark td {
        background-color: #96a0aa;
        border-color: #88939e;
        color: black;
    }

    .alert-dark td .hr > table > tbody > tr > td {
        border-top: 1px solid #88939e;
    }

    .img-fluid {
        height: auto;
        width: 100%;
        max-width: 100%;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6 {
        margin-top: 0;
        margin-bottom: 0;
        font-weight: 500;
        color: inherit;
        text-align: left;
        vertical-align: baseline;
    }

    h1,
    .h1 {
        font-size: 36px;
        line-height: 43.2px;
    }

    h2,
    .h2 {
        font-size: 32px;
        line-height: 38.4px;
    }

    h3,
    .h3 {
        font-size: 28px;
        line-height: 33.6px;
    }

    h4,
    .h4 {
        font-size: 24px;
        line-height: 28.8px;
    }

    h5,
    .h5 {
        font-size: 20px;
        line-height: 24px;
    }

    h6,
    .h6 {
        font-size: 16px;
        line-height: 19.2px;
    }

    .text-left {
        text-align: left !important;
    }

    .text-right {
        text-align: right !important;
    }

    .text-center {
        text-align: center !important;
    }

    .p {
        width: 100%;
    }

    .p > tbody > tr > td {
        margin: 0;
        padding: 0 0 20px 0;
    }

    .p > tbody > tr > td > p {
        margin: 0;
        padding: 0;
    }

    .bg-primary,
    .bg-primary > tbody > tr > td {
        background-color: #007bff;
    }

    .bg-secondary,
    .bg-secondary > tbody > tr > td {
        background-color: #868e96;
    }

    .bg-success,
    .bg-success > tbody > tr > td {
        background-color: #28a745;
    }

    .bg-danger,
    .bg-danger > tbody > tr > td {
        background-color: #dc3545;
    }

    .bg-warning,
    .bg-warning > tbody > tr > td {
        background-color: #ffc107;
    }

    .bg-info,
    .bg-info > tbody > tr > td {
        background-color: #17a2b8;
    }

    .bg-light,
    .bg-light > tbody > tr > td {
        background-color: #f8f9fa;
    }

    .bg-dark,
    .bg-dark > tbody > tr > td {
        background-color: #343a40;
    }

    .text-primary,
    .text-primary > tbody > tr > td {
        color: #007bff;
    }

    .text-secondary,
    .text-secondary > tbody > tr > td {
        color: #868e96;
    }

    .text-success,
    .text-success > tbody > tr > td {
        color: #28a745;
    }

    .text-danger,
    .text-danger > tbody > tr > td {
        color: #dc3545;
    }

    .text-warning,
    .text-warning > tbody > tr > td {
        color: #ffc107;
    }

    .text-info,
    .text-info > tbody > tr > td {
        color: #17a2b8;
    }

    .text-light,
    .text-light > tbody > tr > td {
        color: #f8f9fa;
    }

    .text-dark,
    .text-dark > tbody > tr > td {
        color: #343a40;
    }

    .text-white,
    .text-white > tbody > tr > td {
        color: #ffffff;
    }

    .text-muted,
    .text-mute > tbody > tr > td {
        color: #636c72;
    }

    .preview {
        display: none;
        max-height: 0px;
        overflow: hidden;
    }

    .w-25 {
        width: 25%;
    }

    .w-25 > tbody > tr > td {
        width: 25%;
    }

    .w-50 {
        width: 50%;
    }

    .w-50 > tbody > tr > td {
        width: 50%;
    }

    .w-75 {
        width: 75%;
    }

    .w-75 > tbody > tr > td {
        width: 75%;
    }

    .w-100 {
        width: 100%;
    }

    .w-100 > tbody > tr > td {
        width: 100%;
    }

    .w-auto {
        width: auto;
    }

    .w-auto > tbody > tr > td {
        width: auto;
    }

    .w-lg-25 {
        width: 25%;
    }

    .w-lg-25 > tbody > tr > td {
        width: 25%;
    }

    .w-lg-50 {
        width: 50%;
    }

    .w-lg-50 > tbody > tr > td {
        width: 50%;
    }

    .w-lg-75 {
        width: 75%;
    }

    .w-lg-75 > tbody > tr > td {
        width: 75%;
    }

    .w-lg-100 {
        width: 100%;
    }

    .w-lg-100 > tbody > tr > td {
        width: 100%;
    }

    .w-lg-auto {
        width: auto;
    }

    .w-lg-auto > tbody > tr > td {
        width: auto;
    }

    .p-0 > tbody > tr > td {
        padding: 0;
    }

    .pt-0 > tbody > tr > td,
    .py-0 > tbody > tr > td {
        padding-top: 0;
    }

    .pr-0 > tbody > tr > td,
    .px-0 > tbody > tr > td {
        padding-right: 0;
    }

    .pb-0 > tbody > tr > td,
    .py-0 > tbody > tr > td {
        padding-bottom: 0;
    }

    .pl-0 > tbody > tr > td,
    .px-0 > tbody > tr > td {
        padding-left: 0;
    }

    .p-1 > tbody > tr > td {
        padding: 4px;
    }

    .pt-1 > tbody > tr > td,
    .py-1 > tbody > tr > td {
        padding-top: 4px;
    }

    .pr-1 > tbody > tr > td,
    .px-1 > tbody > tr > td {
        padding-right: 4px;
    }

    .pb-1 > tbody > tr > td,
    .py-1 > tbody > tr > td {
        padding-bottom: 4px;
    }

    .pl-1 > tbody > tr > td,
    .px-1 > tbody > tr > td {
        padding-left: 4px;
    }

    .p-2 > tbody > tr > td {
        padding: 8px;
    }

    .pt-2 > tbody > tr > td,
    .py-2 > tbody > tr > td {
        padding-top: 8px;
    }

    .pr-2 > tbody > tr > td,
    .px-2 > tbody > tr > td {
        padding-right: 8px;
    }

    .pb-2 > tbody > tr > td,
    .py-2 > tbody > tr > td {
        padding-bottom: 8px;
    }

    .pl-2 > tbody > tr > td,
    .px-2 > tbody > tr > td {
        padding-left: 8px;
    }

    .p-3 > tbody > tr > td {
        padding: 16px;
    }

    .pt-3 > tbody > tr > td,
    .py-3 > tbody > tr > td {
        padding-top: 16px;
    }

    .pr-3 > tbody > tr > td,
    .px-3 > tbody > tr > td {
        padding-right: 16px;
    }

    .pb-3 > tbody > tr > td,
    .py-3 > tbody > tr > td {
        padding-bottom: 16px;
    }

    .pl-3 > tbody > tr > td,
    .px-3 > tbody > tr > td {
        padding-left: 16px;
    }

    .p-4 > tbody > tr > td {
        padding: 24px;
    }

    .pt-4 > tbody > tr > td,
    .py-4 > tbody > tr > td {
        padding-top: 24px;
    }

    .pr-4 > tbody > tr > td,
    .px-4 > tbody > tr > td {
        padding-right: 24px;
    }

    .pb-4 > tbody > tr > td,
    .py-4 > tbody > tr > td {
        padding-bottom: 24px;
    }

    .pl-4 > tbody > tr > td,
    .px-4 > tbody > tr > td {
        padding-left: 24px;
    }

    .p-5 > tbody > tr > td {
        padding: 48px;
    }

    .pt-5 > tbody > tr > td,
    .py-5 > tbody > tr > td {
        padding-top: 48px;
    }

    .pr-5 > tbody > tr > td,
    .px-5 > tbody > tr > td {
        padding-right: 48px;
    }

    .pb-5 > tbody > tr > td,
    .py-5 > tbody > tr > td {
        padding-bottom: 48px;
    }

    .pl-5 > tbody > tr > td,
    .px-5 > tbody > tr > td {
        padding-left: 48px;
    }

    .p-lg-0 > tbody > tr > td {
        padding: 0;
    }

    .pt-lg-0 > tbody > tr > td,
    .py-lg-0 > tbody > tr > td {
        padding-top: 0;
    }

    .pr-lg-0 > tbody > tr > td,
    .px-lg-0 > tbody > tr > td {
        padding-right: 0;
    }

    .pb-lg-0 > tbody > tr > td,
    .py-lg-0 > tbody > tr > td {
        padding-bottom: 0;
    }

    .pl-lg-0 > tbody > tr > td,
    .px-lg-0 > tbody > tr > td {
        padding-left: 0;
    }

    .p-lg-1 > tbody > tr > td {
        padding: 4px;
    }

    .pt-lg-1 > tbody > tr > td,
    .py-lg-1 > tbody > tr > td {
        padding-top: 4px;
    }

    .pr-lg-1 > tbody > tr > td,
    .px-lg-1 > tbody > tr > td {
        padding-right: 4px;
    }

    .pb-lg-1 > tbody > tr > td,
    .py-lg-1 > tbody > tr > td {
        padding-bottom: 4px;
    }

    .pl-lg-1 > tbody > tr > td,
    .px-lg-1 > tbody > tr > td {
        padding-left: 4px;
    }

    .p-lg-2 > tbody > tr > td {
        padding: 8px;
    }

    .pt-lg-2 > tbody > tr > td,
    .py-lg-2 > tbody > tr > td {
        padding-top: 8px;
    }

    .pr-lg-2 > tbody > tr > td,
    .px-lg-2 > tbody > tr > td {
        padding-right: 8px;
    }

    .pb-lg-2 > tbody > tr > td,
    .py-lg-2 > tbody > tr > td {
        padding-bottom: 8px;
    }

    .pl-lg-2 > tbody > tr > td,
    .px-lg-2 > tbody > tr > td {
        padding-left: 8px;
    }

    .p-lg-3 > tbody > tr > td {
        padding: 16px;
    }

    .pt-lg-3 > tbody > tr > td,
    .py-lg-3 > tbody > tr > td {
        padding-top: 16px;
    }

    .pr-lg-3 > tbody > tr > td,
    .px-lg-3 > tbody > tr > td {
        padding-right: 16px;
    }

    .pb-lg-3 > tbody > tr > td,
    .py-lg-3 > tbody > tr > td {
        padding-bottom: 16px;
    }

    .pl-lg-3 > tbody > tr > td,
    .px-lg-3 > tbody > tr > td {
        padding-left: 16px;
    }

    .p-lg-4 > tbody > tr > td {
        padding: 24px;
    }

    .pt-lg-4 > tbody > tr > td,
    .py-lg-4 > tbody > tr > td {
        padding-top: 24px;
    }

    .pr-lg-4 > tbody > tr > td,
    .px-lg-4 > tbody > tr > td {
        padding-right: 24px;
    }

    .pb-lg-4 > tbody > tr > td,
    .py-lg-4 > tbody > tr > td {
        padding-bottom: 24px;
    }

    .pl-lg-4 > tbody > tr > td,
    .px-lg-4 > tbody > tr > td {
        padding-left: 24px;
    }

    .p-lg-5 > tbody > tr > td {
        padding: 48px;
    }

    .pt-lg-5 > tbody > tr > td,
    .py-lg-5 > tbody > tr > td {
        padding-top: 48px;
    }

    .pr-lg-5 > tbody > tr > td,
    .px-lg-5 > tbody > tr > td {
        padding-right: 48px;
    }

    .pb-lg-5 > tbody > tr > td,
    .py-lg-5 > tbody > tr > td {
        padding-bottom: 48px;
    }

    .pl-lg-5 > tbody > tr > td,
    .px-lg-5 > tbody > tr > td {
        padding-left: 48px;
    }

    .s-0 > tbody > tr > td {
        font-size: 0;
        line-height: 0;
        height: 0;
    }

    .s-1 > tbody > tr > td {
        font-size: 4px;
        line-height: 4px;
        height: 4px;
    }

    .s-2 > tbody > tr > td {
        font-size: 8px;
        line-height: 8px;
        height: 8px;
    }

    .s-3 > tbody > tr > td {
        font-size: 16px;
        line-height: 16px;
        height: 16px;
    }

    .s-4 > tbody > tr > td {
        font-size: 24px;
        line-height: 24px;
        height: 24px;
    }

    .s-5 > tbody > tr > td {
        font-size: 48px;
        line-height: 48px;
        height: 48px;
    }

    .s-lg-0 > tbody > tr > td {
        font-size: 0;
        line-height: 0;
        height: 0;
    }

    .s-lg-1 > tbody > tr > td {
        font-size: 4px;
        line-height: 4px;
        height: 4px;
    }

    .s-lg-2 > tbody > tr > td {
        font-size: 8px;
        line-height: 8px;
        height: 8px;
    }

    .s-lg-3 > tbody > tr > td {
        font-size: 16px;
        line-height: 16px;
        height: 16px;
    }

    .s-lg-4 > tbody > tr > td {
        font-size: 24px;
        line-height: 24px;
        height: 24px;
    }

    .s-lg-5 > tbody > tr > td {
        font-size: 48px;
        line-height: 48px;
        height: 48px;
    }
</style>
