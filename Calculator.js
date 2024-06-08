import React, { useState } from 'react';
import { View, TextInput, Button, StyleSheet, Text, ScrollView } from 'react-native';

export default function Calculator() {
  const [input1, setInput1] = useState('');
  const [input2, setInput2] = useState('');
  const [result, setResult] = useState('');

  const handlePrimeButtonPress = () => {
    const apiUrl = 'http://192.168.9.180/php/prime.php'; // Update with your actual server path
    console.log('Prime button pressed');
    
    fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        start: input1,
        end: input2,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log('Success:', data);
        if (data.result) {
          setResult(data.result.join(', ')); // Join array of prime numbers into a string
        } else {
          setResult('No primes found or error in request');
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        setResult('Error fetching data');
      });
  };

  // Add similar handlers for other buttons if needed
  const handleFibonacciButtonPress = () => {
    const apiUrl = 'http://192.168.9.180/php/fibbonaci.php'; // Update with your actual server path
    console.log('Fibonacci button pressed');
    
    fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        start: input1,
        end: input2,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log('Success:', data);
        if (data.result) {
          setResult(data.result.join(', ')); // Join array of Fibonacci numbers into a string
        } else {
          setResult('No Fibonacci numbers found or error in request');
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        setResult('Error fetching data');
      });
    console.log('Fibonacci button pressed');
  };

  const handleEvenButtonPress = () => {
    console.log('Even button pressed');
    const apiUrl = 'http://192.168.9.180/php/even.php'; // Update with your actual server path
    console.log('Even button pressed');
    
    fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        start: input1,
        end: input2,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log('Success:', data);
        if (data.result) {
          setResult(data.result.join(', ')); // Join array of even numbers into a string
        } else {
          setResult('No even numbers found or error in request');
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        setResult('Error fetching data');
      });
  };

  const handleRandomButtonPress = () => {
    const apiUrl = 'http://192.168.9.180/php/random.php'; // Update with your actual server path
    console.log('Random button pressed');
    
    fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        start: input1,
        end: input2,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log('Success:', data);
        if (data.result) {
          setResult(data.result.join(', ')); // Join array of random numbers into a string
        } else {
          setResult(data.error || 'No random numbers found or error in request');
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        setResult('Error fetching data');
      });
  };

  return (
    <View style={styles.container}>
      <TextInput
        style={styles.input}
        placeholder="Input 1"
        keyboardType="numeric"
        value={input1}
        onChangeText={setInput1}
      />
      <TextInput
        style={styles.input}
        placeholder="Input 2"
        keyboardType="numeric"
        value={input2}
        onChangeText={setInput2}
      />
      <View style={styles.buttonContainer}>
        <Button title="Prime" onPress={handlePrimeButtonPress} />
        <Button title="Fibonacci" onPress={handleFibonacciButtonPress} />
        <Button title="Even" onPress={handleEvenButtonPress} />
        <Button title="Random" onPress={handleRandomButtonPress} />
      </View>
      {result ? (
        <ScrollView style={styles.resultContainer}>
          <Text style={styles.result}>{result}</Text>
        </ScrollView>
      ) : null}
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    padding: 16,
  },
  input: {
    height: 40,
    borderColor: 'gray',
    borderWidth: 1,
    marginBottom: 12,
    paddingHorizontal: 8,
  },
  buttonContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 16,
  },
  resultContainer: {
    marginTop: 20,
    padding: 10,
    maxHeight: 200, // Adjust based on your needs
  },
  result: {
    fontSize: 18,
  },
});
