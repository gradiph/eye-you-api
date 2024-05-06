
# Eye You API

Eye You Backend API Service.

## API Guide
Postman Collection: https://api.postman.com/collections/1347571-9b0a2cd5-823a-46cb-988b-07d353918ac0?access_key=PMAT-01HAB9WPAFKWK364X27E2SW362

### 1. Test
Each match is called Test.

#### 1.1. View all available tests
```sh
curl --location '${API_ENDPOINT}/admin/tests' \
--header 'Accept: application/json' \
--header 'Authorization: ${ACCESS_TOKEN}'
```

#### 1.2. View one test
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/achievements/${TEST_ID}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}'
```

#### 1.3. Create test
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/tests' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Authorization: Bearer ${API_ENDPOINT}' \
--data-urlencode 'level_id=${LEVEL_ID}' \
--data-urlencode 'mode_id=${MODE_ID}'
```

#### 1.4. Update test
```sh
curl --location --globoff --request PATCH '${ACCESS_TOKEN}/admin/tests/${TEST_ID}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Authorization: Bearer ${API_ENDPOINT}' \
--data-urlencode 'level_id=${LEVEL_ID}' \
--data-urlencode 'mode_id=${MODE_ID}'
```

#### 1.5. Delete test
```sh
curl --location --globoff --request DELETE '${ACCESS_TOKEN}/admin/tests/${TEST_ID}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}'
```

### 2. Question
Each test may has many questions.

#### 2.1. View all available questions
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}'
```

#### 2.2. View one question
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions/${QUESTION_ID}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}'
```

#### 2.3. Create question
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}' \
--form 'image=${QUESTION_IMAGE_FILE}' \
--form 'duration="${QUESTION_DURATION}"'
```

#### 2.4. Update question
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions/${QUESTION_ID}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}' \
--form 'image=${QUESTION_IMAGE_FILE_PATH}' \
--form '_method="PATCH"'
```

#### 2.5. Delete question
```sh
curl --location --globoff --request DELETE '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions/${QUESTION_ID}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}'
```

### 3. Answer
Each question has many answers.

#### 3.1. View all available answers
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions/${QUESTION_ID}/answers' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}'
```

#### 3.2. View one answer
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions/${QUESTION_ID}/answers/${ANSWER_ID}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}'
```

#### 3.3. Create answer
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions/${QUESTION_ID}/answers' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}' \
--form 'image=${ANSWER_IMAGE_FILE_PATH}' \
--form 'alt_text=${ANSWER_ALT_TEXT}' \
--form 'is_correct=${ANSWER_IS_CORRECT}'
```

#### 3.4. Update answer
```sh
curl --location --globoff '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions/${QUESTION_ID}/answers/${ANSWER_ID}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}' \
--form '_method="PATCH"' \
--form 'alt_text=${ANSWER_ALT_TEXT}' \
--form 'is_correct=${ANSWER_IS_CORRECT}'
```

#### 3.5. Delete answer
```sh
curl --location --globoff --request DELETE '${ACCESS_TOKEN}/admin/tests/${TEST_ID}/questions/${QUESTION_ID}/answers/${ANSWER_ID}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${API_ENDPOINT}'
```

