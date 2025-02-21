# Event Backend

## 簡介
**Event Backend** 是一個活動管理後端服務，提供活動建立、管理、報名等功能，支援 RESTful API，並可與前端系統整合。

## 技術棧
- **後端框架**: Laravel (PHP)
- **資料庫**: MySQL
- **認證**: JWT (JSON Web Token)
- **快取**: Redis
- **訊息佇列**: Laravel Queue (如需大量通知或批次處理)
- **API 文件**: Swagger

## 環境需求
- PHP 8.1 以上
- MySQL 8.0 以上
- Redis (選用，但建議開啟以提高效能)
- Composer
- Laravel 依賴管理

## 安裝與設定
1. **Clone 專案**
   ```sh
   git clone https://github.com/answer212224/event_backend.git
   cd event_backend
   ```

2. **安裝相依套件**
   ```sh
   composer install
   ```

3. **設定環境變數**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
   根據需求修改 `.env` 設定，如資料庫連線資訊。

4. **設定資料庫**
   ```sh
   php artisan migrate --seed
   ```
   這將建立資料庫結構並填充初始資料。

5. **啟動伺服器**
   ```sh
   php artisan serve
   ```
   伺服器將在 `http://127.0.0.1:8000` 運行。

## API 使用方式
API 使用 JWT 驗證，請先取得 Token 並附加至請求標頭。

### 1. 取得 JWT Token
```sh
POST /api/login
```
**參數：**
- `email`: 使用者帳號
- `password`: 密碼

回應：
```json
{
    "access_token": "your_token_here",
    "token_type": "bearer",
    "expires_in": 3600
}
```

### 2. 建立活動
```sh
POST /api/events
```
**請求標頭：**
```sh
Authorization: Bearer your_token_here
```
**參數：**
- `title` (string): 活動名稱
- `description` (string): 活動描述
- `start_date` (datetime): 開始時間
- `end_date` (datetime): 結束時間

回應：
```json
{
    "id": 1,
    "title": "技術交流會",
    "description": "Laravel 與 API 設計",
    "start_date": "2025-03-01 10:00:00",
    "end_date": "2025-03-01 12:00:00",
    "created_at": "2025-02-21 10:00:00"
}
```

### 3. 取得活動列表
```sh
GET /api/events
```
回應：
```json
[
    {
        "id": 1,
        "title": "技術交流會",
        "start_date": "2025-03-01 10:00:00",
        "end_date": "2025-03-01 12:00:00"
    },
    ...
]
```

## 測試
執行 PHPUnit 測試：
```sh
php artisan test
```

## 部署
1. 確保 `.env` 配置正確，並執行：
   ```sh
   php artisan config:cache
   php artisan migrate --force
   ```
2. 使用 `supervisor` 管理 Laravel Queue (若有使用)：
   ```sh
   php artisan queue:work
   ```
3. 部署 Nginx / Apache 配置，確保 `public/` 目錄為 Web 入口。

## 貢獻
歡迎提交 PR 來改善專案，請遵循開發規範與代碼格式。

## 授權
本專案採用 **MIT License**。
