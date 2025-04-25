@extends('layouts.app')

@section('content')
    <style>
        .um-container {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .um-header {
            background-color: white;
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .um-user-card {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .um-user-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .um-profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 10px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .um-profile-img img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .um-user-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .um-star-rating {
            color: #e0e0e0;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .um-user-info {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #666;
        }

        .um-pagination-container {
            background-color: #212529;
            padding: 10px 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top: 1px solid #e0e0e0;
        }

        .um-pagination-text {
            margin: 0 15px;
            font-size: 14px;
            color: #666;
        }

        .um-pagination-arrow {
            color: #666;
            cursor: pointer;
            padding: 5px 10px;
        }

        .um-pagination-arrow.um-disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .um-fab-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background-color: #212529;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            font-size: 24px;
        }

        .um-btn-filter,
        .um-btn-options {
            border: 1px solid #212529;
            color: #212529;
            background-color: white;
            font-size: 12px;
            padding: 5px 15px;
            margin-left: 10px;
        }

        .um-view-buttons {
            display: flex;
            gap: 5px;
        }

        .um-view-button {
            border: 1px solid #e0e0e0;
            background-color: white;
            color: #666;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .um-view-button.um-active {
            background-color: #f5f5f5;
        }

        .um-search-container {
            display: flex;
            align-items: center;
        }

        .um-search-icon {
            color: #666;
            margin-right: 5px;
        }

        .um-grid-container {
            padding: 15px;
        }

        .um-grid-row {
            margin-left: -10px;
            margin-right: -10px;
        }

        .um-grid-col {
            padding: 10px;
        }

        /* Modal Styles */
        .um-modal-header {
            background-color: #212529;
            color: white;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .um-modal-title {
            font-size: 16px;
            font-weight: bold;
        }

        .um-modal-options {
            color: white;
            font-size: 12px;
            text-transform: uppercase;
            background: none;
            border: none;
            padding: 0;
        }

        .um-modal-close {
            color: white;
            background: none;
            border: none;
            font-size: 18px;
            padding: 0;
            margin-left: 15px;
        }

        .um-modal-profile {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }

        .um-modal-profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 10px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .um-modal-profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .um-modal-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .um-modal-tabs {
            display: flex;
            border-bottom: 1px solid #e0e0e0;
        }

        .um-modal-tab {
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .um-modal-tab.um-active {
            border-bottom: 2px solid #212529;
            color: #212529;
            font-weight: bold;
        }

        .um-modal-content {
            padding: 15px;
        }

        .um-modal-field {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .um-modal-field-label {
            font-size: 14px;
            color: #666;
        }

        .um-modal-field-value {
            font-size: 14px;
            font-weight: bold;
        }

        .um-modal-call-btn {
            color: #212529;
            background: none;
            border: none;
            font-size: 20px;
        }

        .um-modal-document {
            margin-top: 15px;
        }

        .um-modal-document-title {
            font-size: 14px;
            color: #212529;
            margin-bottom: 5px;
        }

        .um-modal-document-img {
            width: 60px;
            height: 80px;
            border: 1px solid #e0e0e0;
            object-fit: cover;
        }

        .um-create-header {
            background-color: #212529;
            color: white;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .um-create-title {
            font-size: 16px;
            font-weight: bold;
        }

        .um-create-icons {
            display: flex;
            gap: 15px;
        }

        .um-create-icon {
            color: white;
            font-size: 16px;
        }

        .um-create-section {
            background-color: #f5f5f5;
            padding: 10px 15px;
            font-size: 12px;
            font-weight: bold;
            color: #666;
            border-bottom: 1px solid #e0e0e0;
        }

        .um-create-form {
            padding: 15px;
        }

        .um-create-profile {
            width: 100px;
            height: 100px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .um-create-profile i {
            font-size: 40px;
            color: #999;
        }

        .um-create-footer {
            padding: 10px 15px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #e0e0e0;
        }

        .um-create-cancel {
            background-color: #f5f5f5;
            border: 1px solid #e0e0e0;
            color: #666;
            padding: 5px 15px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .um-create-save {
            background-color: #212529;
            border: none;
            color: white;
            padding: 5px 15px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .um-create-add {
            color: #212529;
            font-size: 12px;
            text-transform: uppercase;
            text-align: right;
            display: block;
            margin-top: 5px;
            text-decoration: none;
        }

        .um-create-section-title {
            font-size: 14px;
            font-weight: bold;
            color: #666;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e0e0e0;
        }

        .um-flag-select {
            display: flex;
            align-items: center;
        }

        .um-flag {
            width: 20px;
            height: 15px;
            margin-right: 5px;
        }

        .form-label {
            font-size: 12px;
            color: #666;
        }

        .form-label.required::after {
            content: "*";
            color: red;
            margin-left: 2px;
        }

        .um-reference-header {
            background-color: #212529;
            color: white;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .um-reference-title {
            font-size: 16px;
            font-weight: bold;
        }

        .um-reference-close {
            color: white;
            background: none;
            border: none;
            font-size: 18px;
            padding: 0;
        }

        .um-reference-form {
            padding: 15px;
        }

        .um-reference-footer {
            padding: 10px 15px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #e0e0e0;
        }

        .um-reference-cancel {
            background-color: white;
            border: none;
            color: #000;
            padding: 5px 15px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .um-reference-add {
            background-color: #212529;
            border: none;
            color: white;
            padding: 5px 15px;
            font-size: 12px;
            text-transform: uppercase;
        }
    </style>
    <h2 class="mt-4">Todos los Clientes</h2>


    <div class="main-container">
        <!-- Header con búsqueda y exportar -->
        <div class="header-table">
            <div class="search-container">
                <input type="text" class="form-control" placeholder="Buscar...">
            </div>
            <div class="header-actions">
                <button class="btn">Filtrar</button>
                <button class="btn">Opciones</button>
                <button class="btn"><i class="hgi hgi-stroke hgi-left-to-right-list-bullet fs-6"></i></button>
                <!--<button class="btn"><i class="hgi hgi-stroke hgi-grid-table fs-6"></i></button>-->
            </div>
        </div>

        <!-- Tabla de registros -->
        <div class="table-responsive">
            <div class="container-fluid">
                <!-- User Grid -->
                <div class="um-grid-container container-fluid">
                    <div class="um-grid-row row g-3">
                        <!-- User 1 -->
                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal" data-user-id="1"
                                data-user-name="CHALAFE DAVID">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">CHALAFE DAVID</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <!-- User 2 -->
                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal" data-user-id="2"
                                data-user-name="JAVIER JOSE NOVA GOMEZ">
                                <div class="um-profile-img">
                                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-LPS9T4tBphMZYUJPvqdBKqmCeUtwHG.png"
                                        alt="Profile" style="object-position: -267px -45px; transform: scale(3);">
                                </div>
                                <div class="um-user-name">JAVIER JOSE NOVA GOMEZ</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <!-- User 3 -->
                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal" data-user-id="3"
                                data-user-name="RAFAEL LOPEZ">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">RAFAEL LOPEZ</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <!-- User 4 -->
                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal" data-user-id="4"
                                data-user-name="MIGUEL ANGEL ALVAREZ TOLEDO">
                                <div class="um-profile-img">
                                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-LPS9T4tBphMZYUJPvqdBKqmCeUtwHG.png"
                                        alt="Profile" style="object-position: -690px -45px; transform: scale(3);">
                                </div>
                                <div class="um-user-name">MIGUEL ANGEL ALVAREZ TOLEDO</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <!-- User 5 -->
                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal" data-user-id="5"
                                data-user-name="Richard R Rodriguez Montero">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">Richard R Rodriguez Montero</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <!-- User 6 -->
                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal"
                                data-user-id="6" data-user-name="Vladimir (Bucha) Cepin Mufua">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">Vladimir (Bucha) Cepin Mufua</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <!-- User 7 -->
                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal"
                                data-user-id="7" data-user-name="Rubelin Cueva Cueva">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">Rubelin Cueva Cueva</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <!-- User 8 -->
                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal"
                                data-user-id="8" data-user-name="Rafael Gomes Cueva">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">Rafael Gomes Cueva</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Users 9-12 (Empty profiles) -->
                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal"
                                data-user-id="9" data-user-name="Usuario">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">Usuario</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal"
                                data-user-id="10" data-user-name="Usuario">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">Usuario</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal"
                                data-user-id="11" data-user-name="Usuario">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">Usuario</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>

                        <div class="um-grid-col col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="um-user-card" data-bs-toggle="modal" data-bs-target="#userModal"
                                data-user-id="12" data-user-name="Usuario">
                                <div class="um-profile-img">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                                <div class="um-user-name">Usuario</div>
                                <div class="um-star-rating">
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                    <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                </div>
                                <div class="um-user-info">
                                    <span>Capital: $0</span>
                                    <span>Balance: $0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="header-table" style="background-color: #212529;"> -->
        <div class="um-pagination-container rounded-pill mx-2">
            <div class="um-pagination-text text-white">15</div>
            <div class="um-pagination-text text-white">1-15 de 129</div>
            <div class="um-pagination-arrow text-white um-disabled"><i class="hgi hgi-stroke hgi-arrow-left-01"></i>
            </div>
            <div class="um-pagination-arrow text-white"><i class="hgi hgi-stroke hgi-arrow-right-01"></i></div>
        </div>
        <!-- </div> -->
        <!-- Estado vacío -->
        <div class="empty-state">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" alt="No hay registros">
            <p>No tienes Registros!</p>
        </div>
    </div>
    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="um-modal-header">
                    <div class="um-modal-title">Contacto</div>
                    <div class="d-flex align-items-center">
                        <button class="um-modal-options">OPCIONES</button>
                        <button class="um-modal-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="hgi hgi-stroke hgi-time-quarter-02 fs-6"></i>
                        </button>
                    </div>
                </div>
                <div class="um-modal-profile">
                    <div class="um-modal-profile-img">
                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-bidFTKkvY9iMJ2pfAmKvGIVz8yEid0.png"
                            alt="Profile" style="object-position: -140px -35px; transform: scale(2);">
                    </div>
                    <div class="um-modal-name" id="modalUserName">JAVIER JOSE NOVA GOMEZ</div>
                </div>
                <div class="um-modal-tabs">
                    <div class="um-modal-tab um-active">DATOS</div>
                    <div class="um-modal-tab">EMPLEO</div>
                    <div class="um-modal-tab">PRESTAMOS</div>
                </div>
                <div class="um-modal-content">
                    <div class="um-modal-field">
                        <div class="um-modal-field-label">RD2962749</div>
                        <div class="um-modal-field-value">Cédula</div>
                    </div>
                    <div class="um-modal-field">
                        <div class="um-modal-field-label">
                            <div class="um-star-rating">
                                <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                <i class="hgi hgi-stroke hgi-star fs-6"></i>
                                <i class="hgi hgi-stroke hgi-star fs-6"></i>
                            </div>
                        </div>
                        <div class="um-modal-field-value">0</div>
                    </div>
                    <div class="um-modal-field">
                        <div class="um-modal-field-label">809112747</div>
                        <button class="um-modal-call-btn">
                            <i class="hgi hgi-stroke hgi-hold-phone fs-6"></i>
                        </button>
                    </div>
                    <div class="um-modal-field">
                        <div class="um-modal-field-label">Teléfono</div>
                        <div class="um-modal-field-value">8091127347</div>
                    </div>
                    <div class="um-modal-field">
                        <div class="um-modal-field-label">Estado</div>
                        <div class="um-modal-field-value">Activo</div>
                    </div>
                    <div class="um-modal-field">
                        <div class="um-modal-field-label">Sexo</div>
                        <div class="um-modal-field-value">M</div>
                    </div>
                    <div class="um-modal-field">
                        <div class="um-modal-field-label">Domiciliado</div>
                        <div class="um-modal-field-value">Si</div>
                    </div>
                    <div class="um-modal-field">
                        <div class="um-modal-field-label">Fecha de Nacimiento</div>
                        <div class="um-modal-field-value">15/07/1984</div>
                    </div>
                    <div class="um-modal-document">
                        <div class="um-modal-document-title">Documento</div>
                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-bidFTKkvY9iMJ2pfAmKvGIVz8yEid0.png"
                            alt="Document" class="um-modal-document-img"
                            style="object-position: -140px -240px; transform: scale(2);">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade um-create-modal" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="um-create-header">
                    <div class="um-create-title">Crear Cliente</div>
                    <div class="um-create-icons">
                        <i class="hgi hgi-stroke hgi-hotel-bell fs-6"></i>
                        <i class="hgi hgi-stroke hgi-message-question fs-6"></i>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="um-create-section">DATOS GENERALES</div>
                    <div class="um-create-form">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="um-create-profile mb-3">
                                    <i class="hgi hgi-stroke hgi-user fs-3"></i>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="tags" class="form-label required">Tags</label>
                                        <select class="form-select form-select-sm" id="tags">
                                            <option>Persona</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="identificacion" class="form-label required">No.
                                            Identificación</label>
                                        <input type="text" class="form-control form-control-sm" id="identificacion">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nombres" class="form-label required">Nombres</label>
                                        <input type="text" class="form-control form-control-sm" id="nombres">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="apellidos" class="form-label required">Apellidos</label>
                                        <input type="text" class="form-control form-control-sm" id="apellidos">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cedula" class="form-label required">Cédula</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">
                                                <div class="um-flag-select">

                                                    <i class="hgi hgi-stroke hgi-document-attachment fs-6"></i>
                                                </div>
                                            </span>
                                            <input type="text" class="form-control" id="cedula">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="telefono" class="form-label required">Teléfono</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">
                                                <div class="um-flag-select">

                                                    <i class="hgi hgi-stroke hgi-hold-phone fs-6"></i>
                                                </div>
                                            </span>
                                            <input type="text" class="form-control" id="telefono">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="nacionalidad" class="form-label required">Nacionalidad</label>
                                        <select class="form-select form-select-sm" id="nacionalidad">
                                            <option>Dominicana</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="genero" class="form-label">Género</label>
                                        <select class="form-select form-select-sm" id="genero">
                                            <option>Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="condicion" class="form-label">Condición Laboral</label>
                                        <select class="form-select form-select-sm" id="condicion">
                                            <option>Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="ingresos" class="form-label">Ingresos</label>
                                        <input type="text" class="form-control form-control-sm" id="ingresos"
                                            value="$0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="estado-civil" class="form-label">Estado Civil</label>
                                        <select class="form-select form-select-sm" id="estado-civil">
                                            <option>Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dependientes" class="form-label">Dependientes</label>
                                        <input type="number" class="form-control form-control-sm" id="dependientes"
                                            value="0">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="limite" class="form-label">Límite de Crédito</label>
                                        <input type="text" class="form-control form-control-sm" id="limite"
                                            value="0">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <input type="text" class="form-control form-control-sm" id="direccion">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="direccion2" class="form-label">Dirección 2</label>
                                        <input type="text" class="form-control form-control-sm" id="direccion2">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="codigo-postal" class="form-label">Código Postal</label>
                                        <input type="text" class="form-control form-control-sm" id="codigo-postal">
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="fecha-nacimiento" class="form-label">Fecha de Nacimiento</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="fecha-nacimiento"
                                                placeholder="dd / mm / yyyy">
                                            <span class="input-group-text"><i
                                                    class="hgi hgi-stroke hgi-calendar-03 fs-6"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control form-control-sm" id="email">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="pais" class="form-label">País</label>
                                        <input type="text" class="form-control form-control-sm" id="pais">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="usuario" class="form-label">Usuario</label>
                                        <input type="text" class="form-control form-control-sm" id="usuario">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contrasena" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control form-control-sm" id="contrasena">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="numero" class="form-label required">Número</label>
                                        <input type="text" class="form-control form-control-sm" id="numero">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="no-cuenta" class="form-label">No. Cuenta</label>
                                        <input type="text" class="form-control form-control-sm" id="no-cuenta">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="calle" class="form-label">Calle</label>
                                        <input type="text" class="form-control form-control-sm" id="calle">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="um-create-section">ADJUNTOS</div>
                    <div class="um-create-form">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="um-create-section-title">Agregar fotos de cédula y cualquier otro documento de
                                interés.</div>
                            <a class="um-create-add">AGREGAR</a>
                        </div>
                    </div>

                    <div class="um-create-section">REFERENCIAS</div>
                    <div class="um-create-form">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="um-create-section-title">Agregar contactos de referencia.</div>
                            <a class="um-create-add" data-bs-toggle="modal" data-bs-target="#referenceModal">AGREGAR</a>
                        </div>
                    </div>
                </div>
                <div class="um-create-footer">
                    <button class="um-create-cancel" data-bs-dismiss="modal">CANCELAR</button>
                    <button class="um-create-save">GUARDAR</button>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade um-reference-modal" id="referenceModal" tabindex="-1" aria-labelledby="referenceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="um-reference-header">
                    <div class="um-reference-title">Agregar Referencia</div>
                    <button class="um-reference-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="um-reference-form">
                    <div class="mb-3">
                        <label for="reference-tipo" class="form-label required">Tipo</label>
                        <select class="form-select" id="reference-tipo">
                            <option selected>Personal</option>
                            <option>Laboral</option>
                            <option>Familiar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reference-nombre" class="form-label required">Nombre completo</label>
                        <input type="text" class="form-control" id="reference-nombre">
                    </div>
                    <div class="mb-3">
                        <label for="reference-telefono" class="form-label required">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <div class="um-flag-select">

                                    <span class="ms-1">+1</span>
                                </div>
                            </span>
                            <input type="text" class="form-control" id="reference-telefono">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="reference-parentesco" class="form-label required">Parentesco</label>
                        <select class="form-select" id="reference-parentesco">
                            <option selected>Cónyuge</option>
                            <option>Padre/Madre</option>
                            <option>Hermano/a</option>
                            <option>Hijo/a</option>
                            <option>Amigo/a</option>
                            <option>Colega</option>
                        </select>
                    </div>
                </div>
                <div class="um-reference-footer">
                    <button class="um-reference-cancel" data-bs-dismiss="modal">CANCELAR</button>
                    <button class="um-reference-add">AGREGAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Botón flotante para agregar -->
    <a class="btn btn-primary btn-floating" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="hgi hgi-stroke hgi-plus-sign-circle fs-3"></i>
    </a>
@endsection
